<?php

namespace App\Http\Controllers;

use App\Models\ApplicationType;
use App\Models\Base;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SearchController extends Controller
{
    function index()
    {
      $bases = Base::paginate(2);
        return view('list', [
            'bases' => $bases
        ]);
       
    }

    
   
   function action(Request $request)
       {
        if($request->get('query'))
        {
         $query = $request->get('query');
         //$data = Base::all();
         $data = DB::table('bases')
           ->where('dbname', 'LIKE', "%{$query}%")
           ->get();
   
           $total_row = $data->count();
           if($total_row > 0)
            {
      
                  foreach($data as $key=>$base)
                  {
                      if(++$key %2 != 0){
                      
                      $output = '    <section class="page-section clearfix">
                      <div class="container">
                      <div class="intro"> 

                      <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src=' .asset('storage/'.$base->index_img_path). '>
                      <div class="intro-text left-0 text-center bg-faded p-5 rounded">  '  ;  }
                      else {
                            
                          $output = '    <section class="page-section clearfix">
                          <div class="container">
                          <div class="intro"> 
                          <img class="intro-img0 img-fluid mb-3 mb-lg-0 rounded" src=' .asset("storage/".$base->index_img_path).'>
                          <div class="intro-text0 left-0 text-center bg-faded p-5 rounded ">' ;  }
                              
                      $output .= ' <h2 class="section-heading mb-4"> <span class="section-heading-lower">'.$base->dbname. ' </span>
                      </h2>';


                      $output .= ' <ul class="no_bullets ">';
                      $output .= '<li class=" flex"><p class="left01">Number of images : </p> <p>'.$base->nbimages. ' </p>
                      </li>';
                      $output .= '<li  class=" flex" > <p class="left02">Description : </p><p>'.$base->description. ' </p>
                      </li>';
                      
                      $data1 = DB::table('application_types')
                      ->where('id', 'LIKE', "%{$base->application_types_id}%")
                      ->get();
                      
                      foreach($data1 as $key=>$base1)
                    {
                      $output .= '  <li class=" flex"><p class="left01">Application type : </p> <p>'. $base1->application_name. '</p>
                      </li> ';
                    }

                    $output .= '<div class="intro-button mx-auto">';
                    
                    $output .= ' <a class="btn btn-primary btn-xl" href=' .env('DO_REPO_LINK').$base->bdd_img_path. '>Download </a>
                
                      </div>
                      </div>
                      </div>
                    </div>
                  </section> ';
                           
                  echo $output;

                    }

        }
        else
        {
         $output = '
         <tr>
          <td class = "error" align="center" colspan="5">No Data Found</td>
         </tr>
         ';
         echo $output;
        }

         
       
      
        } 


    }
}