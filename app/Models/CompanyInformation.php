<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    protected $table = 'company_information'; // jouw tabelnaam

    protected $fillable = [
        'user_id',
        'company_name',
        'vat_number',
        'address',
        'postal_code',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
