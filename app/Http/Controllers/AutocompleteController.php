<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
class AutocompleteController extends Controller
{
    ////for create controller - php artisan make:controller AutocompleteController

    function index()
    {
     return view('autocomplete');
    }

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('bases')
        ->where('dbname', 'LIKE', "%{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {
       $output .= '
       <li><a href="#">'.$row->dbname.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
}


