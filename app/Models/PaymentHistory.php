<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $fillable=[
        'payment_id',
        'order_id',
        'amount',
        'fee',
        'charged_amount',
        'payment_method',
        'sender_number',
        'transaction_id',
        'date',
        'status'
    ];
}
