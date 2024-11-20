<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $order = Order::join('domains','domains.domain_id','=','orders.domain_id')->where('status','In Progress')->get();
        return view('admin.index',['order'=>$order]);
    }
}
