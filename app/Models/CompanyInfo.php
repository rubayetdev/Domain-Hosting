<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $fillable = [
        'companyEmail',
        'companyName',
        'companyLogo',
        'fname',
        'lname',
        'phone',
        'wpNumber',
        'city',
        'postal_code',
        'country',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
