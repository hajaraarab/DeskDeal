<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reservation;

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
    public function store(Product $product)
    {


        Reservation::create([
            'product_id' => $product->id,
            'buyer_id' => auth()->id(),
            'seller_id' => $product->user_id,
            'status' => 'pending',
        ]);

        $product->update([
            'status' => 'reserved'
        ]);

        return redirect()
        ->route('reservations.create', $product);
    }
}
