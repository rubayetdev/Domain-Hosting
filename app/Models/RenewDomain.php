<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RenewDomain extends Model
{
    protected $fillable = [
        'order_id',
        'customer_id',
        'domain_id',
        'register_date',
        'expire_date',
        'domain_type',
        'price',
        'status',
        'payment_id'
    ];
}
