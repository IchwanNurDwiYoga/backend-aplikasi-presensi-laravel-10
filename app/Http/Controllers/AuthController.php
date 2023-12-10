<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(){
        $admin = Admin::all()->count();
        if($admin == null){
            return view('content.admin.admin_create');
        }
        return view('auth.login',);
    }

    public function auth(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {

            // $request->session()->regenerate();

            return redirect()->intended('/home');
        }

        return redirect('/login')->with(['warning' => 'Email / Password Salah!']);
    }
    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            return redirect('/login');
        }
    }
}
