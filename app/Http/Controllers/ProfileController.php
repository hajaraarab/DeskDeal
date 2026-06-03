<?php

namespace App\Http\Controllers;

use App\Models\Reservation;


class ProfileController extends Controller
{

    public function show()
    {
        $user = auth()->user();

        $reservations = Reservation::with([
        'buyer',
        'product'
        ])
        ->where(function ($query) use ($user) {
            $query->where('seller_id', $user->id)
                ->orWhere('buyer_id', $user->id);
        })
        ->latest()
        ->get();

        return view('profile.show', [
            'user' => $user,
            'reservations' => $reservations,
        ]);
    }

}