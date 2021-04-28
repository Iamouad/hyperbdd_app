<?php

namespace App\Http\Controllers;

use App\Models\ApplicationType;
use App\Models\Base;
use App\Models\User;

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
         $data = DB::table('bases')
           ->where('dbname', 'LIKE', "%{$query}%")
           ->get();
        }

        else{
          $data = Base::all();
        }
        
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
                      <div class="intro-text left-0 text-center bg-faded p-5 rounded btn"  onclick="changeWindow('.$base->id. ')" >  '  ;  }
                      
                      else {
                       
                          $output = '<section class="page-section clearfix">
                          <div class="container">
                          <div class="intro"> 
                          <img class="intro-img0 img-fluid mb-3 mb-lg-0 rounded" src=' .asset("storage/".$base->index_img_path).'>
                          <div class="intro-text0 left-0 text-center bg-faded p-5 rounded btn" style="height: 346px;" onclick="changeWindow('.$base->id. ')" >  '  ;   }
                              
                      $output .= ' <h2 class="section-heading mb-4"> <span class="section-heading-lower">'.$base->dbname. ' </span>
                      </h2>';


                      $output .= ' <ul class="no_bullets ">';
                      $output .= '<li class=" flex m-2"><span class="badge p-2 mx-2 badge-primary">Creation Date  </span> <span>'.$base->created_at. ' </span>
                      </li>';
                      $output .= '<li class=" flex m-2"><span class="badge p-2 mx-2  badge-secondary">Application Type </span> <span>'.ApplicationType::where('id',$base->application_types_id )->pluck('application_name')[0] . ' </span>
                      </li>';
                      $output .= '<li class=" flex m-2"><span class="badge p-2 mx-2 badge-light">Number of Images </span> <span>'.$base->nbimages. ' </span>
                      </li>';
                      $output .= '<li class=" flex m-2"><span class="badge p-2 mx-2 badge-dark">Number of Downloads </span> <span id= "downloads".'.$base->id.'>'.$base->nb_downloads. ' </span>
                      </li>';
                      $output .= '<li  class=" flex m-2" > <span class="badge p-2 mx-2 badge-info">Description </span><span class="d-inline-block text-truncate" style="max-width: 250px;">'.$base->description. ' </span>
                      </li>';
                      
                  

                    $output .= '<div class="intro-button mx-auto">';
                    
                    $output .= ' <a class="btn btn-primary btn-lg mx-1" onclick="incrementDownload('.$base->id.')"  href=' .env('DO_REPO_LINK').$base->bdd_img_path. '>Download </a>';
                    if (auth()->user() !=null){
                    if (auth()->user()->isInRole("admin") || auth()->user()->isOwner($base)){
                    $output .= '<a class="btn btn-danger btn-lg"  onclick="deleteBase('.$base->id.')" href="#">Delete </a>';
                    }}
                   
           

                  
                   $output .= '</div>
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