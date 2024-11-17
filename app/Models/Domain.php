<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $fillable=[
        'domain_id',
        'domain_name',
        'domain_price',
        'domain_transfer_price',
        'domain_renew_price',
        'reseller_domain_price',
        'reseller_domain_transfer_price',
        'reseller_domain_renew_price',
        'expiration_months'
    ];
}
