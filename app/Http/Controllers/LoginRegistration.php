<?php

namespace App\Http\Controllers;

use App\Models\CompanyInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;
class LoginRegistration extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function loggedIn(Request $request)
    {
        $credential = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credential,$remember)){
            $user = Auth::user();

            //return $this->authenticated($request, $user);
            return redirect()->route('dashboard');
        }
        else
            return redirect()->back()->withErrors(['email' => 'Invalid email or password.'])->withInput();
    }
    public function store(Request $request)
    {
        $now = Carbon::now('Asia/Dhaka')->format('YmdHis');
        static $increment = 1;
        $user_id = $increment++ . $now;

        $validatedData = $request->validate([
            'companyName' => 'required|string|max:100',
            'companyEmail' => 'required|string|max:255|email|unique:company_infos,companyEmail',
            'password' => 'required|string|min:8|confirmed',
            'fname' => 'required|string|max:20',
            'lname' => 'required|string|max:20',
            'username' => 'required|string|max:50',
            'userEmail' => 'required|string|max:255|email|unique:users,email',
            'phone' => 'required|string|max:11|min:11|unique:company_infos,phone',
            'wpNumber' => 'required|string|max:11|min:11|unique:company_infos,wpNumber',
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
                ]);

            CompanyInfo::create([
                'user_id' => $user_id,
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
//            event(new Registered($user));

            $this->whatsApp($validatedData['wpNumber']);

            $message = 'We sent a confirmation email to ' . $validatedData['userEmail'] . '. If you don’t see it, please check your spam folder!';
            return redirect()->back()->with('success',$message);

        }
        else {
            $errorMessage = 'The photo upload failed. Please try again.';
            return redirect()->back()->with('error', $errorMessage);
        }

    }

    public function whatsApp($wpNumber)
    {
        $twilioSid = env('TWILIO_SID');
        $twilioToken = env('TWILIO_AUTH_TOKEN');
        $twilioWhatsAppNumber = env('TWILIO_WHATSAPP_NUMBER');
        $recipientNumber = 'whatsapp:+88' . $wpNumber;
        $message = "Hello from Programming Experience";

        $twilio = new Client($twilioSid, $twilioToken);

        try {
            $twilio->messages->create(
                $recipientNumber,
                [
                    "from" => 'whatsapp:'.$twilioWhatsAppNumber,
                    "body" => $message,
                ]
            );

            return response()->json(['message' => 'WhatsApp message sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function verifyEmail()
    {
        return view('auth.verify-email');
    }

    public function emailVerification(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect('/login');
    }

    public function resendEmailLink(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    public function logout()
    {
        Auth::logout();

        session()->flush();

        return redirect()->route('register');
    }
}
