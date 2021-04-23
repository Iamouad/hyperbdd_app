<?php

namespace App\Http\Controllers\auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:20',
            'lastname' => 'required|max:20',
            'email' => 'required|email|max:200',
            'password' => 'required|min:5|confirmed'

        ]);
        try {
            //code...
            User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role_id' => 3,
                'validated_by_admin' => 0
            ]);
        } catch (Exception $ex) {
            //throw $th;
            return redirect()->back()->with("status", $ex->getMessage());

        }

        // waiting for admin validation 
        // if(Auth::attempt($request->only('email', 'password'), $request->remember)){
        //     return redirect()->route('dashboard');
        // }
        return redirect()->to('login')->with("status", "Your account needs to be validated by the administrators !!");
        

    }
}
