<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;


#[Fillable([
    'user_id',
    'category_id',
    'title',
    'description',
    'location',
    'status',
    'price', 
    'is_free',
])]

class Product extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
