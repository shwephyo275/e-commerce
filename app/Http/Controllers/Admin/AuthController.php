<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->guard('admin')->check()) {
            return redirect('/admin')->with('success', 'You already login');
        }
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        if (auth()->guard('admin')->check()) {
            return redirect('/admin')->with('success', 'You already login');
        }
        $checkAuth = auth()->guard('admin')->attempt($request->only('email', 'password'));
        if (!$checkAuth) {
            return redirect()->back()->with('error', 'Email and password dont match.');
        }
        return redirect('/admin')->with('success', 'Welcome ' . auth()->guard('admin')->user()->name);
    }

    public function logout()
    {
        auth()->guard('admin')->logout();
        return redirect('/admin/login');
    }
}
