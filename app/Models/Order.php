<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'reservation_id',
        'product_id',
        'buyer_id',
        'seller_id',
        'price',
        'delivery_method',
        'delivery_address',
        'pickup_date',
        'pickup_time',
        'status',
        'rescheduled_by_user_id',
    ];
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function rescheduledBy()
    {
        return $this->belongsTo(User::class, 'rescheduled_by_user_id');
    }
}
