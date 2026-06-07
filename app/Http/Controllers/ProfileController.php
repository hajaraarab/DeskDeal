<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{

    public function show()
    {
        $user = auth()->user();

        $userProducts = $user->products()
            ->with([
                'images',
                'category',
                'reservations'
            ])
            ->latest()
            ->get();

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
            'userProducts' => $userProducts,
            'reservations' => $reservations,
        ]);
    }

    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user(),
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'companyname' => ['required', 'string', 'max:255'],
            'companyregisternumber' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
        ]);

        $user->update($validated);

        return redirect()->route('profile.show')
            ->with('success', 'Je profiel is succesvol bijgewerkt.');
    }

}