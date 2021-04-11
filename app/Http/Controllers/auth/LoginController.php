<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:100',
            'password' => 'required|min:5'

        ]);

        if(Auth::attempt($request->only('email', 'password'), $request->remember)){
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with("status", "This account doesn't exist!!");
        // else{
        //     \dd(Auth::attempt($request->only('email', 'password')));
        // }
    }
}
