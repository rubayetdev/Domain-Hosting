<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('user.dashboard');
    }

    public function profile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('user.profile');
    }
}
