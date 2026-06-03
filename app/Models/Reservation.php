<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'product_id',
    'buyer_id',
    'seller_id',
    'status',
])]

class Reservation extends Model
{
    //
}
