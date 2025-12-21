<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'loginemail' => ['required', 'email'], 
            'loginpassword' => 'required'
        ]); 

        if (auth()->attempt(['email' => $incomingFields['loginemail'], 'password' => $incomingFields['loginpassword']])) {
            $request->session()->regenerate(); //beveiliging tegen session fixation attacks
        }

        return redirect('/')->with('success', 'Je bent succesvol ingelogd!'); 
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'Je bent succesvol uitgelogd!'); 
    }

    public function register(Request $request)
    {
        $incomingFields = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')], 
            'password' => 'required|min:4'
        ]); 

        $incomingFields['password'] = bcrypt($incomingFields['password']); //wachtwoord hashen voor het in de database te steken
        $user = User::create($incomingFields); 
        auth()->login($user); //automatisch inloggen na registratie

        return redirect('/')->with('success', 'Je bent succesvol geregistreerd!'); //doorsturen naar homepagina na registratie
    }
}
