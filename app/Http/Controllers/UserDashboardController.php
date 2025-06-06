<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('user-dashboard');
        }else{
            return redirect()->route('auth');
        }
    }
}
