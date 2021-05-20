<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Image;
// use Image;

class ProfileController extends Controller
{

    //
    public function profile(){
    	return view('auth.profile', array('user' => Auth::user()) );
    }

    public function update_avatar(Request $request){

    	// Handle the user upload of avatar
    	if($request->hasFile('avatar')){
    		$avatar = $request->file('avatar');
    		$filename = time() . '.' . $avatar->getClientOriginalExtension();
    		Image::make($avatar)->resize(300, 300)->save( public_path('/images/avatars/' . $filename ) );

    		$user = Auth::user();
    		$user->avatar = $filename;
    		$user->save();
    	}

    	return view('auth.profile', array('user' => Auth::user()) );

	}

    public function update(Request $request)
    {
        $data=User::find($request->id);
        $data->phone_number=$request->phone_number;
        $data->phone_number=$request->phone_number;
        $data->academic_career=$request->academic_career;
        $data->description=$request->description;
        $data->save();
        return redirect()->route('dashboard');
    }
	
   
}