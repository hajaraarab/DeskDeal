<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function reschedule(Order $order)
    {
        return view('orders.reschedule', [
            'order' => $order,
            'product' => $order->product,
        ]);
    }
    public function storeReschedule(Request $request, Order $order)
    {
        $request->validate([
            'pickup_date' => 'required|date',
            'pickup_time' => 'required',
        ]);

        $order->update([
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'rescheduled_by_user_id' => auth()->id(),
        ]);

        return redirect()
            ->route('reservations.index')
            ->with(
                'success',
                'Het nieuwe leveringsmoment werd succesvol voorgesteld.'
            );
    }
    public function rescheduleConfirm(Order $order)
    {
        return view('orders.reschedule-confirm', [
            'order' => $order,
        ]);
    }
}
