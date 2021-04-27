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
         
         <div class ="flex">
         <div class="card card-space0">
          <div class="card-body">
            <h5 class="card-title">Creation date </h5>
               <p class="card-text">{{$base['created_at']->diffForHumans()}}</p>
 
         </div>
        </div>

        <div class="card card-space" >
          <div class="card-body">
            <h5 class="card-title">Published by  </h5>
               <p class="card-text">{{$base->user->firstname.' '.$base->user->lastname}}</p>
 
         </div>
        </div>

        <div class="card card-space">
          <div class="card-body">
            <h5 class="card-title">Application type </h5>
               <p class="card-text">{{$base->applicationType->application_name}}</p>
 
         </div>
        </div>
      </div>
      <br>
      <br>

      <div class ="flex">
         <div class="card card-space0">
          <div class="card-body">
            <h5 class="card-title">Number of images </h5>
               <p class="card-text"> {{$base['nbimages']}}</p>
 
         </div>
        </div>

        <div class="card card-space" >
          <div class="card-body">
            <h5 class="card-title">Classification rate  </h5>
               <p class="card-text">{{$base['classification_rate'].'%'}}</p>
 
         </div>
        </div>

        <div class="card card-space">
          <div class="card-body">
            <h5 class="card-title">Number of downloads </h5>
               <p class="card-text" id={{'downloads'.$base->id}}>{{$base['nb_downloads']}}</p>
 
         </div>
        </div>
      </div>
      <br>
      <br>

      <div class="card card-space1 " >
          <div class="card-body">
            <h5 class="card-title">Description </h5>
               <p class="card-text">{{$base['description']}}</p>
 
         </div>
        </div>
      <br>
      <br>

        <div class="card card-space1" >
          <div class="card-body">
            <h5 class="card-title">References </h5>
               <p class="card-text">{{$base['references']}}</p>
 
         </div>
        </div>
        <br>
      <br>
     
         
         
         <div class="intro-button mx-auto">
           <a class="btn btn-primary btn-lg"  onclick="incrementDownload({{$base->id}})" href={{env('DO_REPO_LINK').$base->bdd_img_path}}>Download </a>
           @auth
{{-- <<<<<<< HEAD --}}
           @if (auth()->user()->isInRole("admin") || auth()->user()->isOwner($base))
           <a class="btn btn-danger btn-lg" onclick="deleteBase({{$base->id}})" href="#">Delete </a>
{{-- =======
           @if (auth()->user()->isInRole("admin"))
           <a class="btn btn-danger btn-xl " onclick="deleteBase({{$base->id}})" href="#">Delete </a>
>>>>>>> 9db7ece698eb94f4a4e795e6e05f82492dc4e658 --}}
           @endauth
           
           @endif
         </div>
         </div>
       
       </div>
     </div>
   </div>
 </section>

  @else
  <h2 style="text-align:center; margin:6px; color:white">No data in the database </h2>

  @endif
</div>
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