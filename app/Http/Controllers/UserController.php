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
}
