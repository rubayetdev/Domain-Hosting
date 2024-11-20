<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class ManageDomain extends Controller
{
    public function index(string $id, Request $request)
    {
        $domain = Order::find($id);
        if ($domain == null) {
            return redirect()->back();
        }
        $check = \App\Models\ManageDomain::where('order_no',$domain->order_id)->where('customer_id',$domain->customer_id)->first();
        return view('admin.domains.manageDomain',['domain'=>$domain,'check'=>$check]);
    }

    public function customerList()
    {
        $user = User::join('company_infos','users.user_id','=','company_infos.user_id')->get();

        return view('admin.customers.customersList',['user'=>$user]);
    }

    public function store(Request $request)
    {
        $order = $request->input('orderno');
        $customer = $request->input('customerno');
        $check = \App\Models\ManageDomain::where('order_no',$order)->where('customer_id',$customer)->first();
        if($check)
        {
            $check->update([
                'ns1'=>$request->input('domain1'),
                'ns2'=>$request->input('domain2'),
                'ns3'=>$request->input('domain3'),
                'ns4'=>$request->input('domain4'),
            ]);
            return redirect()->back();
        }
        else
            \App\Models\ManageDomain::create([
                'order_no'=>$order,
                'customer_id'=>$request->input('customerno'),
                'ns1'=>$request->input('domain1'),
                'ns2'=>$request->input('domain2'),
                'ns3'=>$request->input('domain3'),
                'ns4'=>$request->input('domain4'),
                'eppcode'=>$request->input('epp_code')
            ]);
        Order::where('order_id',$order)->update([
            'status'=>'Active'
        ]);
        return redirect()->back();
    }
}
