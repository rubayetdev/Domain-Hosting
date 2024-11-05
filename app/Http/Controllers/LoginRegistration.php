<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoginRegistration extends Controller
{
    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Dhaka')->format('YmdHis');
        static $increment = 1;
        $user_id = $increment++ . $now;

        $validatedData = $request->validate([
            'companyName' => 'required|string|max:100',
            'companyEmail' => 'required|string|max:255|email|unique:users,companyEmail',
            'password' => 'required|string|min:8|confirmed',
            'fname' => 'required|string|max:20',
            'lname' => 'required|string|max:20',
            'username' => 'required|string|max:50',
            'userEmail' => 'required|string|max:255|email|unique:users,email',
            'phone' => 'required|string|max:11|min:11|unique:users,phone',
            'wpNumber' => 'required|string|max:11|min:11|unique:users,wpNumber',
            'city'=>'required|string|max:15',
            'code'=>'required|string|max:10',
            'country'=>'required|string|max:100',
        ]);

        if ($request->hasFile('photo')) {
            $extension = $request->file('photo')->getClientOriginalExtension();

            $fileName = $validatedData['companyName'] .'_'.$now. '.' . $extension;

            $path = $request->file('photo')->storeAs('photos', $fileName, 'public');


            $user = User::create([
                'user_id' => $user_id,
                'name'=>$validatedData['username'],
                'email'=>$validatedData['userEmail'],
                'password'=>bcrypt($validatedData['password']),
                'companyEmail'=>$validatedData['companyEmail'],
                'companyName'=>$validatedData['companyName'],
                'companyLogo'=>$path,
                'fname'=>$validatedData['fname'],
                'lname'=>$validatedData['lname'],
                'phone'=>$validatedData['phone'],
                'wpNumber'=>$validatedData['wpNumber'],
                'city'=>$validatedData['city'],
                'postal_code'=>$validatedData['code'],
                'country'=>$validatedData['country'],
            ]);


            $message = 'We sent a confirmation email to ' . $validatedData['companyEmail'] . '. If you don’t see it, please check your spam folder!';
            return redirect()->back()->with('success',$message);

        }
        else {
            $errorMessage = 'The photo upload failed. Please try again.';
            return redirect()->back()->with('error', $errorMessage);
        }

    }
}
