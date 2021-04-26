<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email|max:100',
            'password' => 'required'

        ]);

        if(Auth::attempt($request->only('email', 'password'), $request->remember)){
            if(! Auth::user()->validated_by_admin){
                Auth::logout();
                return redirect()->to('login')->with("status", "Your account needs to be validated by the administrators !!");
            }
            return redirect()->route('dashboard');
        }
        return redirect()->to('login')->with("status", "This account doesn't exist!!");
        // else{
        //     \dd(Auth::attempt($request->only('email', 'password')));
        // }
    }
}
