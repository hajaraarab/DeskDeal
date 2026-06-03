<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function create(Product $product)
    {
        return view('reservations.create', [
            'product' => $product,
            'buyer' => auth()->user(),
            'seller' => $product->user,
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

        return redirect()
            ->route('reservations.create', $product)
            ->with('success', 'Reservering bevestigd.');
    }
}
