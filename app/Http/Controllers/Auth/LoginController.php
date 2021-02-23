<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function auth(Request $request)
    {
        if($request->pass === 'WizoIsth3W!zo') {
            $request->session()->regenerate();
            Auth::login(User::find(1));
            return redirect()->route('berimtoo.dashboard');
        }
    }

    public function login()
    {
        return view('login');
    }
}
