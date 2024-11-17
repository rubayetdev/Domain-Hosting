<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DomainControll extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.domains.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        static $increment = 1;
        $domain_id = Str::random(4).'_'.$increment++;

        $validatedData = $request->validate([
            'domain'=>'required|string|unique:domains,domain_name',
            'price'=>'required|numeric|min:1',
            'tprice'=>'required|numeric|min:1',
            'rprice'=>'required|numeric|min:1',
            'rdprice'=>'required|numeric|min:1',
            'rtprice'=>'required|numeric|min:1',
            'rdrprice'=>'required|numeric|min:1',
            'expiration_number' => 'required|numeric|min:1',
            'expiration_unit' => 'required|in:month,year',
        ]);

        $expirationInMonths = $validatedData['expiration_unit'] === 'month'
            ? $validatedData['expiration_number']
            : $validatedData['expiration_number'] * 12;

        Domain::create([
            'domain_id'=>$domain_id,
            'domain_name'=>$validatedData['domain'],
            'domain_price'=>$validatedData['price'],
            'domain_transfer_price'=>$validatedData['tprice'],
            'domain_renew_price'=>$validatedData['rprice'],
            'reseller_domain_price'=>$validatedData['rdprice'],
            'reseller_domain_transfer_price'=>$validatedData['rtprice'],
            'reseller_domain_renew_price'=>$validatedData['rdrprice'],
            'expiration_months' => $expirationInMonths
        ]);

        return redirect()->back()->with('success','Domain created successfully');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $domain = Domain::all();

        return view('admin.domains.domainList',['domains'=>$domain]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $domain = Domain::find($id);

        return view('admin.domains.showDomain',['domain'=>$domain]);
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
        $domain = Domain::find($id);

        $expirationInMonths = $request->input('expiration_unit') === 'month'
            ? $request->input('expiration_number')
            : $request->input('expiration_number') * 12;

        $domain->update([
            'domain_name'=>$request->input('domain'),
            'domain_price'=>$request->input('price'),
            'domain_transfer_price'=>$request->input('tprice'),
            'domain_renew_price'=>$request->input('rprice'),
            'reseller_domain_price'=>$request->input('rdprice'),
            'reseller_domain_transfer_price'=>$request->input('rtprice'),
            'reseller_domain_renew_price'=>$request->input('rdrprice'),
            'expiration_months' => $expirationInMonths
        ]);

        return redirect()->back()->with('success','Domain updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $domain = Domain::find($id);

        $domain->delete();

        return redirect()->back();
    }
}
