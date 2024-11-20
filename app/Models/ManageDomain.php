<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManageDomain extends Model
{
    protected $fillable = [
        'order_no',
        'customer_id',
        'ns1',
        'ns2',
        'ns3',
        'ns4',
        'eppcode'
    ];
}
