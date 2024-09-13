<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard()
    {

            return view('dashboard/home', ['title' => "Dashboard", 'halaman' => "Dashboard", 'active' => 'Dashboard',]);

    }

    public function awal() {

            return redirect()->intended('/dashboard');


    }

    public function home() {

        return view('auth/login', ['title' => "Login"]);

    }

    public function login(Request $request) {
        
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        if(Auth::attempt($credentials )) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'username atau password salah, silakan coba lagi')->withInput();

    }

    public function logout(Request $request) {
        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
