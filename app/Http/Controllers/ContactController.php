<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        Mail::to('hajar.aarab@student.kdg.be')->send(
            new ContactFormMail($validated)
        );

        return back()->with(
            'success',
            'Je bericht werd succesvol verzonden.'
        );
    }
}