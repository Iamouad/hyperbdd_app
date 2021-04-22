<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    //
    function show()
    {
        //return User::all();
        $data = User::all();
        return view('dashboard',['infos'=>$data]);
    }
}
