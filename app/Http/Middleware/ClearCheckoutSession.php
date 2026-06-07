<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ClearCheckoutSession
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $allowed = [
            'reservations.checkout',
            'reservation.appointment.preview',
            'reservation.make',
            'reservation.appointment',
        ];

        $routeName = $request->route() ? $request->route()->getName() : null;

        if ($request->session()->has('checkout_appointment') && ! in_array($routeName, $allowed, true)) {
            $request->session()->forget('checkout_appointment');
        }

        return $next($request);
    }
}
