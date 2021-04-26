<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Base;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $bases = Base::paginate(2);
        return view('dashboard', [
            'bases' => $bases
        ]);
    }
}

