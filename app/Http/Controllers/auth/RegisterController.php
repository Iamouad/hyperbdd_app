<?php

namespace App\Http\Controllers\auth;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


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
            'password' => 'required|min:5|confirmed',
            'phone_number'=>'min:10|required',
            'fax'=>'min:10|required',
            'academic_career' => 'required|max:5000',
            'description' => 'required|max:5000',
            // 'birth_date' => 'required|date_format:Y-m-d',
            'avatar' => 'required|file|image'
            
            ]);
        try {
            $avatar = $request->file('avatar');
            $extention = $avatar->extension();
            $mimeType = $avatar->getMimeType();
            $filename = time() ;
            Storage::disk('public')->putFileAs('images',$avatar ,$filename.'.'.$extention);
            //code...
            User::create([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone_number' => $request->phone_number,
                'fax' => $request->fax,
                'academic_career'=>$request->academic_career,
                'description'=>$request->description,
                'avatar_path' => 'images/'.$filename.'.'.$extention,
                'role_id' => 2,
                'validated_by_admin' => 0]);

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
    public function edit()
    {
       
        return view('auth.edit');
    }

    public function update(Request $request)
    {
        
        $data=Auth::user();
        $data->phone_number=$request->phone_number;
        $data->fax=$request->fax;
        $data->academic_career=$request->academic_career;
        $data->description=$request->description;
        if($request->file('avatar')){
            Storage::disk('public')->delete($data->avatar_path);
            $avatar = $request->file('avatar');
            $extention = $avatar->extension();
            $filename = time();
            Storage::disk('public')->putFileAs('images',$avatar ,$filename.'.'.$extention);
            $data->avatar_path='images/'.$filename.'.'.$extention;
        }
        $data->save();
        return redirect()->route('profile', ["id"=> Auth::user()->id]);
    }

}
