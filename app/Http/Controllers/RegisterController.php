<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CompanyInformation;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function storeStep1(Request $request)
    {
        $incomingFields = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')], 
            'password' => ['required', 'min:4']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']); //wachtwoord hashen voor het in de database te steken

        //$user = User::create($incomingFields); 
        
        session(['register.step1' => $incomingFields]);
        return redirect()->route('register.step2');
    }
    public function storeStep2(Request $request)
    {
        $incomingFields = $request->validate([
            'company_name' => ['required'],
            'vat_number' => ['required', 'size:12'],
            'address' => ['required'],
            'postal_code' => ['required', 'digits:4'],
            'city' => ['required']
        ]); 

        session(['register.step2' => $incomingFields]);
        return redirect()->route('register.step3');
    }
    public function storeStep3(Request $request)
    {
        $incomingFields = $request->validate([
            'profile_picture' => ['image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]); 

        $filename = null; 

        if($request->hasFile('profile_picture')) {
            $filename = time() . '_' . $request->profile_picture->getClientOriginalName(); 
            $request->profile_picture->storeAs('profile_pictures', $filename, 'public'); 
        }
        $incomingFields['profile_picture'] = $filename;

        $step1 = session('register.step1');
        $step2 = session('register.step2');

        if (User::where('email', $step1['email'])->exists()) {
            return redirect()
                ->route('register.step1')
                ->withErrors(['email' => 'Dit e-mailadres is al in gebruik.'])
                ->withInput();
        }
        
        $user = User::create([
            'first_name' => $step1['first_name'], 
            'last_name' => $step1['last_name'],
            'email' => $step1['email'],
            'password' => $step1['password'],
            'profile_picture' => $incomingFields['profile_picture']
        ]); 

        CompanyInformation::create([
            'user_id' => $user->id,
            'company_name' => $step2['company_name'],
            'vat_number' => $step2['vat_number'],
            'address' => $step2['address'],
            'postal_code' => $step2['postal_code'],
            'city' => $step2['city']
        ]); 

        auth()->login($user);
        //Clear registration data from session
        session()->forget(['register.step1', 'register.step2']);

        return redirect('/')->with('success', 'Je bent succesvol geregistreerd!'); //doorsturen naar homepagina na registratie
    }
}
