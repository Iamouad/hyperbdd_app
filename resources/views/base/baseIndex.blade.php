@extends('app')

@section('content')


<main >
  @if ($base)
  <section class="page-section clearfix">
   <div class="container">
     <div class="intro" >
       <div class=" text-center bg-faded p-3 rounded">            
         <h2 class="section-heading mb-4">
           <span class="section-heading-lower text-primary">{{$base->dbname}}</span>
         </h2>

         <div >
            <ul class="flex justify-content-center">
                <div class="m-2">
                <li class=" flex"><p class="left01">Creation date : </p> <p>{{$base['created_at']->diffForHumans()}}</p>
                </li>
                <li class=" flex"><p class="left01">Published by : </p> <p>{{$base->user->firstname.' '.$base->user->lastname}}</p>
                </li>
                <li class=" flex"><p class="left01">Application type : </p> <p>{{$base->applicationType->application_name}}</p>
                </li>
                </div>
                <div class="m-2">
                <li class="flex"><p class="left00">Number of images : </p> <p> {{$base['nbimages']}} </p>
                </li>
                <li class="flex"><p class="left00">Classification rate : </p> <p> {{$base['classification_rate'].'%'}} </p>
                </li>
                <li class=" flex"><p class="left01">Number of downloads : </p> <p id={{'downloads'.$base->id}}>{{$base['nb_downloads']}}</p>
                </li>
                </div>    
              </ul>
              <div class="m-2 flex justify-content-center">
              <div>
                  <h3 class="text-primary">Description</h3>
                <p class="d-inline-block " style="max-width: 500px;">{{$base['description']}}</p>
              </div>
              <div>
                <h3 class="text-primary">References</h3>
              <p class="d-inline-block " style="max-width: 500px;">{{$base['references']}}</p>
              </div>
              </div>
         </div>
         
         
         <div class="intro-button mx-auto">
           <a class="btn btn-primary btn-lg" onclick="incrementDownload({{$base->id}})" href={{env('DO_REPO_LINK').$base->bdd_img_path}}>Download </a>
           @auth
           @if (auth()->user()->isInRole("admin") || auth()->user()->isOwner($base))
           <a class="btn btn-danger btn-lg" onclick="deleteBase({{$base->id}})" href="#">Delete </a>
           @endauth
           
           @endif
         </div>
       
       </div>
     </div>
   </div>
 </section>

  @else
  <h2 style="text-align:center; margin:6px; color:white">No data in the database </h2>

  @endif

</main>

<script>
  
  function incrementDownload(baseId){
    console.log(baseId)
          var CSRF_TOKEN =$('[name="_token"]').val();
          $.ajax({
              url:'/increment-download',
              type:'get',
              dataType: 'json',
               data: {'baseId': baseId, _token: CSRF_TOKEN},
              success: function (result, status) {
                  $('#downloads'+baseId).text(result.nbDownloads)
                  //location.reload()
              },
              error : function(result, status, error){
                  console.log(error)
              }
          
          })
         
      }

      function deleteBase(baseId){
          var CSRF_TOKEN =$('[name="_token"]').val();
          $.ajax({
              url:'/delete-base',
              type:'post',
              dataType: 'json',
               data: {'baseId': baseId, _token: CSRF_TOKEN},
              success: function (result, status) {
                  location.reload()
              },
              error : function(result, status, error){
                  console.log(error)
              }
          
          })
         
      }

      function changeWindow(baseId) {
        console.log(baseId, 'changeWindow')
        window.location.href='bases/'+baseId;
      }

      

</script>

@endsection