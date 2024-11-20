<?php

namespace App\Http\Controllers;

use App\Http\Controllers\UddoktapayController;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $order = Order::where('customer_id', Auth::user()->user_id)->join('domains','domains.domain_id','=','orders.domain_id')->get();
        return view('user.dashboard',['orders' => $order]);
    }

    public function profile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('user.profile');
    }

    public function domainManage(string $id, Request $request)
    {
        $domain = Order::find($id);
        if ($domain == null) {
            return redirect()->back();
        }
        $check = \App\Models\ManageDomain::where('order_no',$domain->order_id)->where('customer_id',Auth::user()->user_id)->first();
        return view('user.domainManage',['domain'=>$domain,'check'=>$check]);
    }

    public function renewDomain()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $check = Order::where('customer_id',Auth::user()->user_id)->join('domains','domains.domain_id','=','orders.domain_id')->get();
        return view('user.renewDomain',['orders'=>$check]);
    }
    protected $uddoktapay;

    public function __construct(UddoktapayController $uddoktapay){
        $this->uddoktapay = $uddoktapay;
    }
    public function payDomain(Request $request)
    {
        $domain = Order::where('id',$request->input('order_id'))->first();
        $amount =  $request->input('amount');
        $now = Carbon::now('Asia/Dhaka')->format('md');
        $random = mt_rand(100, 999);
        $order = $now . $random;

        session(['invoice' => $order]);
        session(['amount' => $amount]);
        session(['type'=>$request->input('type')]);
        session(['domain_id' => $request->input('domain_id')]);

        return $this->uddoktapay->pay(new Request(['total' => $amount]));
    }
}
