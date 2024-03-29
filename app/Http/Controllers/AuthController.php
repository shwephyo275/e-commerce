<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect('/')->with('error', 'You already login');
        }
        return view('auth.login');
    }
    public function login(Request $request)
    {
        //validation
        //check email
        $checkUser = User::where('email', $request->email)->first();
        if (!$checkUser) {
            return redirect('/')->with('error', 'Eamil not found.');
        }
        //attempt
        $checkAuth =  auth()->attempt($request->only('email', 'password'));
        if (!$checkAuth) {
            return redirect('/')->with('error', 'Wrong Password.');
        }
        return redirect('/')->with('success', 'Welcome ' . auth()->user()->name);
    }

    public function showRegister()
    {
        if (auth()->check()) {
            return redirect('/')->with('error', 'You already login');
        }
        return view('auth.register');
    }
    public function register(Request $request)
    {
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|max:10',
            'phone' => 'required',
            'delivery_address' => 'required'
        ]);

        $created_user  =  User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'delivery_address' => $request->delivery_address,
        ]);

        auth()->login($created_user);
        return redirect('/')->with('success', 'Welcome ' . auth()->user()->name);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/login');
    }
}
