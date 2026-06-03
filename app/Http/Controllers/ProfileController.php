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
        ->where('seller_id', $user->id)
        ->where('status', 'pending')
        ->latest()
        ->get();

        return view('profile.show', [
            'user' => $user,
            'reservations' => $reservations,
        ]);
    }

}