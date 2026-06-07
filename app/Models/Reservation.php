<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'product_id',
    'buyer_id',
    'seller_id',
    'status',
    'message', 
    'delivery_method',
    'delivery_address',
    'pickup_date',
    'pickup_time',
    'appointment_status',
])]

class Reservation extends Model
{
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
