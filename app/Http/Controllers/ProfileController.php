<?php

namespace App\Http\Controllers;

use Auth;
use Image;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Image;

class ProfileController extends Controller
{

    //
    public function profile(Request $request){
    	return view('auth.profile', array('user' => User::find($request->id)) );
    }


   
}