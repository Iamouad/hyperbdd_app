<?php

namespace App\Http\Controllers\auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Http\Requests;

class LoginController extends Controller
{
    public function index()
    {
     return view('auth.login');
    }

    public function checklogin(Request $request)
    {
     $this->validate($request, [
      'email'   => 'required|email',
      'password'  => 'required|alphaNum|min:3'
     ]);
     
     $user_data = array(
        'email'  => $request->get('email'),
        'password' => $request->get('password')
       );
  
       if(Auth::attempt($user_data))
       {
        return redirect('login/successlogin');
       }
       else
       {
        return back()->with('error', 'Wrong Login Details');
       }
    }   

    public function successlogin()
    {
    return view('app');
    }

   /* function logout()
    {
    Auth::logout();
    return redirect('login');
    }*/
     

    
}
