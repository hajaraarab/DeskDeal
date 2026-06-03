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

        $product->update([
            'status' => 'reserved'
        ]);

        return redirect()
        ->route('reservations.create', $product);
    }
    public function accept(Reservation $reservation)
    {
        $reservation->update([
            'status' => 'accepted',
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
}
