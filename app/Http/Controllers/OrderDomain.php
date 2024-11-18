<?php

namespace App\Http\Controllers;

use App\Models\Domain;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UddoktapayController;

class OrderDomain extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $domain = Domain::all();
        return view('user.orderDomain',['domains'=>$domain]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    protected $uddoktapay;

    public function __construct(UddoktapayController $uddoktapay){
        $this->uddoktapay = $uddoktapay;
    }
    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Dhaka')->format('md');
        $random = mt_rand(100, 999);
        $order = $now . $random;
        $amount =  $request->input('amount');

        session(['type' => $request->input('type')]);
        session(['invoice' => $order]);

        return $this->uddoktapay->pay(new Request(['total' => $amount]));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $domain = Domain::find($id);
        return view('user.domainInfo',['domains'=>$domain]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
