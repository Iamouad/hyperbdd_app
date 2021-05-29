<?php

namespace App\Http\Controllers\admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\AccountValidated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //
   public function pendedUsers()
   {
    switch (true) {
        case Auth::user()->isInRole("admin"):
            $pendedUsers = User::where('validated_by_admin', 0)->orderBy('created_at', 'ASC')->get();               
            return view('admin.pended_users', [
                'pendedUsers' => $pendedUsers
            ]);
            break;
   }
   
}

    public function rejectUser(Request $request )
    {
        User::destroy($request->userId);
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        return response()->json($response); 
        
    }

    public function approveUser(Request $request )
    {
        $user = User::find($request->userId);
        $user->validated_by_admin = true;
        $user->role_id=2;

        $user->save();
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
       
        Mail::to($user)->send(new AccountValidated($user->firstname));
        return response()->json($response); 
    }

    public function getUsers()
    {
        $users = User::with(['role'])->where('id', '<>', Auth::user()->id)->get();
        $roles = Role::get();
        return view('layouts.users', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function changePermission(Request $request )
    {
        $user = User::find($request->userId);
        $user->role_id = $request->roleId;
        $user->save();
        $response = array(
            'status' => 'success',
            'msg' => $request->message,
        );
        return response()->json($response); 
    }

    
}
