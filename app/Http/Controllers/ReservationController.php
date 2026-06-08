<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function create(Product $product)
    {
        $hasReservation = Reservation::where('product_id', $product->id)
            ->where('buyer_id', auth()->id())
            ->exists();

        return view('reservations.create', [
            'product' => $product,
            'hasReservation' => $hasReservation,
        ]);
    }
    public function store(Request $request, Product $product)
    {
        Reservation::create([
            'product_id' => $product->id,
            'buyer_id' => auth()->id(),
            'seller_id' => $product->user_id,
            'status' => 'pending',
            'message' => $request->message, 
        ]);

        return redirect()
        ->route('reservations.create', $product);
    }
    public function accept(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'accepted',
        ]);

        $reservation->product->update([
            'status' => 'reserved',
        ]);

        return back();
    }

    public function reject(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'rejected',
        ]);

        return back();
    }
    public function checkout(Reservation $reservation)
    {
        abort_unless(
            $reservation->buyer_id === auth()->id(),
            403
        );

        abort_unless(
            $reservation->status === 'accepted',
            403
        );

        return view('reservations.checkout', [
            'reservation' => $reservation,
            'product' => $reservation->product,
        ]);
    }
    public function index(Request $request)
    {
        $user = auth()->user();

        $tab = $request->get('tab', 'requests');
        $status = $request->get('status', 'all');

        if ($tab === 'my-reservations') {

            $query = Reservation::with([
                'product',
                'seller'
            ])
            ->where('buyer_id', $user->id);

        } else {

            $query = Reservation::with([
                'buyer',
                'product'
            ])
            ->where('seller_id', $user->id);
        }

        if ($status === 'pending') {

            $query->where(function ($q) {

                $q->where('status', 'pending')

                ->orWhere(function ($q) {
                        $q->where('status', 'accepted')
                        ->whereNull('appointment_status');
                })

                ->orWhere(function ($q) {
                        $q->where('status', 'accepted')
                        ->where('appointment_status', 'pending');
                });

            });

        } elseif ($status === 'accepted') {

            $query->where('status', 'accepted')
                ->where('appointment_status', 'accepted');

        } elseif ($status === 'rejected') {

            $query->where('status', 'rejected');

        }
        $reservations = $query
        ->latest()
        ->get();

        return view('reservations.index', [
            'reservations' => $reservations,
            'tab' => $tab,
            'status' => $status,
        ]);
    }
    public function appointmentPreview(Request $request, Reservation $reservation)
    {
        if ($request->delivery_method === 'delivery') {

            $request->validate([
                'deliveryadres' => [
                    'required',
                    'string',
                    'min:5'
                ]
            ]);
        }

        if ($request->delivery_method === 'pickup') {

            $request->validate([
                'pickup-date' => [
                    'required',
                    'date',
                    'after_or_equal:today'
                ],

                'pickup_time' => [
                    'required',
                    'date_format:H:i'
                ]
            ]);
        }

        session([
            'checkout_appointment' => [
                'delivery_method' => $request->delivery_method,
                'delivery_address' => $request->deliveryadres,
                'pickup_date' => $request->input('pickup-date'),
                'pickup_time' => $request->pickup_time,
            ]
        ]);

        return view('reservations.confirmation', [
            'reservation' => $reservation,
            'product' => $reservation->product,
        ]);
    }

    public function confirmAppointment(Reservation $reservation)
    {
        $appointment = session('checkout_appointment');

        if (!$appointment) {
            return redirect()
                ->route('reservations.checkout', $reservation)
                ->with('error', 'Geen afspraak gevonden.');
        }

        $pickupDate = $appointment['pickup_date'];
        $pickupTime = $appointment['pickup_time'];

        if ($appointment['delivery_method'] === 'delivery') {
            $pickupDate = '2026-06-19';
            $pickupTime = '10:30';
        }

        $reservation->update([
            'delivery_method' => $appointment['delivery_method'],
            'delivery_address' => $appointment['delivery_address'],
            'pickup_date' => $appointment['pickup_date'],
            'pickup_time' => $appointment['pickup_time'],
            'appointment_status' => 'accepted',
        ]);

        Order::create([
            'reservation_id'   => $reservation->id,
            'product_id'       => $reservation->product_id,
            'buyer_id'         => $reservation->buyer_id,
            'seller_id'        => $reservation->seller_id,
            'price'            => $reservation->product->price,
            'delivery_method'  => $appointment['delivery_method'],
            'delivery_address' => $appointment['delivery_address'],
            'pickup_date'      => $appointment['pickup_date'],
            'pickup_time'      => $appointment['pickup_time'],
            'status'           => 'placed',
        ]);

        session()->forget('checkout_appointment');

        return redirect()
        ->route('reservation.completed', $reservation);
    }
    public function make(Reservation $reservation)
    {
        return view('reservations.make', [
            'reservation' => $reservation,
            'product' => $reservation->product,
            'reservation' => $reservation,
        ]);
    }
}
