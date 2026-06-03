<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function show()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        try {
                $validated = $request->validate([
                    'firstname' => 'required|string|max:255',
                    'lastname' => 'required|string|max:255',
                    'companyname' => 'required|string|max:255',
                    'companyregisternumber' => ['required', 'regex:/^BE\d{10}$/'],
                    'city' => 'required|string|max:255',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required|min:8',
                ],
                [
                    'companyregisternumber.required' => 'Enkel bedrijven kunnen deze site gebruiken.',
                    'companyregisternumber.digits' => 'Enkel bedrijven kunnen deze site gebruiken.',
                    'companyregisternumber.regex' => 'Gelieve een geldig ondernemingsnummer in te vullen (bv. BE0123456789).', 
                    'email.unique' => 'Er bestaat al een account met dit e-mailadres.', 
                ]
            ); 

            $user =User::create([
                'firstname' => $validated['firstname'],
                'lastname' => $validated['lastname'],
                'companyname' => $validated['companyname'],
                'companyregisternumber' => $validated['companyregisternumber'],
                'email' => $validated['email'],
                'city' => $validated['city'],
                'password' => Hash::make($validated['password']),
            ]);

            Auth::login($user); 
            
            return redirect('/')
                ->with('success', 'Je account is succesvol aangemaakt ! Welkom bij DeskDeal, ' . $user->firstname);
        }
        catch (\Exception $e) {
            //dd($e->getMessage());
            return back()
            ->withInput()
            ->with('error', 'Er is een fout opgetreden tijdens het registreren. Probeer het opnieuw.')
            ;
        }
    }
}