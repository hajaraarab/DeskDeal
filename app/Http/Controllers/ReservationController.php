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

        if ($tab === 'my-reservations') {

            $reservations = Reservation::with([
                'product',
                'seller'
            ])
            ->where('buyer_id', $user->id)
            ->latest()
            ->get();

        } else {

            $reservations = Reservation::with([
                'buyer',
                'product'
            ])
            ->where('seller_id', $user->id)
            ->latest()
            ->get();
        }

        return view('reservations.index', [
            'reservations' => $reservations,
            'tab' => $tab,
        ]);
    }
    public function storeAppointment(Request $request, Reservation $reservation)
    {
        if ($request->delivery_method === 'delivery') {

            $validated = $request->validate([
                'deliveryadres' => [
                    'required',
                    'string',
                    'min:5'
                ]
            ]);

            $reservation->update([
                'delivery_method' => 'delivery',
                'delivery_address' => $validated['deliveryadres'],
                'appointment_status' => 'pending'
            ]);
        }
        if ($request->delivery_method === 'pickup') {

            $validated = $request->validate([
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

            $reservation->update([
                'delivery_method' => 'pickup',
                'pickup_date' => $validated['pickup-date'],
                'pickup_time' => $validated['pickup_time'],
                'appointment_status' => 'pending'
            ]);
        }
        return redirect()
        ->with('success', 'Afspraak verzonden.');

    }
}
