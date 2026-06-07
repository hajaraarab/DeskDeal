<?php

namespace App\Http\Controllers;

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

        if ($status !== 'all') {
            $query->where('status', $status);
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

        $reservation->update([
            'delivery_method' => $appointment['delivery_method'],
            'delivery_address' => $appointment['delivery_address'],
            'pickup_date' => $appointment['pickup_date'],
            'pickup_time' => $appointment['pickup_time'],
            'appointment_status' => 'pending',
        ]);

        session()->forget('checkout_appointment');

        return redirect()
        ->route('reservation.completed', $reservation);
    }
    public function make(Reservation $reservation)
    {
        return view('reservations.make', [
            'reservation' => $reservation,
        ]);
    }
}
