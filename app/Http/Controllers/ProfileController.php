<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request,$id)
    {

//        dd($id);
        $now = Carbon::now('Asia/Dhaka')->format('YmdHis');
        $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',user_id',
            'phone' => 'nullable|string|max:20',
            'companyName' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'companyLogo' => 'nullable|image|max:2048',
            'cemail' => 'required|email|unique:company_infos,companyEmail,' . $id . ',user_id',
            'wphone'=>'nullable|string|max:20'
        ]);

        User::where('user_id',$id)->update([
            'email'=>$request->email
        ]);
        $companyInfo = CompanyInfo::where('user_id', $id)->first();

        if (!$companyInfo) {
            return redirect()->back()->withErrors(['error' => 'Company info not found']);
        }
        $companyInfo->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'phone' => $request->phone,
            'companyName' => $request->companyName,
            'city' => $request->city,
        ]);

        if ($request->hasFile('companyLogo')) {
            // Delete the old logo if it exists
            if ($companyInfo->companyLogo && Storage::exists('public/' . $companyInfo->companyLogo)) {
                Storage::delete('public/' . $companyInfo->companyLogo);
            }

            $extension = $request->file('companyLogo')->getClientOriginalExtension();
            $fileName = $request->companyName .'_'.$now. '.' . $extension;
            $path = $request->file('companyLogo')->storeAs('photos', $fileName, 'public');
            $companyInfo->update(['companyLogo' => $path]);
        }

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
