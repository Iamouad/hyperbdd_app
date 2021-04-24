@extends('app')

@section('content')


<main >
  @if ($bases->count() > 0)
  @foreach($bases as $key=>$base)
  <section class="page-section clearfix">
   <div class="container">
     <div class="intro">
       @if(++$key %2 != 0)
       <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="{{asset('storage/'.$base->index_img_path)}}" alt="">
       <div class="intro-text left-0 text-center bg-faded p-5 rounded">            
       @else
       <img class="left img-fluid mb-3 mb-lg-0 rounded" src="{{asset('storage/'.$base->index_img_path)}}" alt="">
       <div class="intro-text left-0 text-center bg-faded p-5 rounded right">
       @endif
     
         <h2 class="section-heading mb-4">
           <span class="section-heading-lower">{{$base->dbname}}</span>
         </h2>

         
         <ul class="no_bullets ">
           <li class=" flex"><p class="left01">Creation date : </p> <p>{{$base['created_at']->diffForHumans()}}</p>
           </li>
           <li class=" flex"><p class="left01">Application type : </p> <p>{{$base->applicationType->application_name}}</p>
           </li>
           <li class="flex"><p class="left00">Number of images : </p> <p> {{$base['nbimages']}} </p>
           </li>
           <li class=" flex"><p class="left01">Number of downloads : </p> <p id={{'downloads'.$base->id}}>{{$base['nb_downloads']}}</p>
           </li>
           <li  class=" flex" > <p class="left02">Description : </p><p>{{$base['description']}}</p>
           </li>
       
         </ul>
         <div class="intro-button mx-auto">
           <a class="btn btn-primary btn-lg" onclick="incrementDownload({{$base->id}})" href={{env('DO_REPO_LINK').$base->bdd_img_path}}>Download </a>
           @if (auth()->user()->isInRole("admin"))
           <a class="btn btn-danger btn-lg" onclick="deleteBase({{$base->id}})" href="#">Delete </a>

           @endif
         </div>
       
       </div>
     </div>
   </div>
 </section>
 @endforeach
{{-- Pagination --}}
<div class="d-flex justify-content-center">
 {{ $bases->links() }}
</div>
  @else
  <h2 style="text-align:center; margin:6px; color:white">No data in the database </h2>

  @endif

</main>

<script>
  
  function incrementDownload(baseId){
          var CSRF_TOKEN =$('[name="_token"]').val();
          $.ajax({
              url:'/increment-download',
              type:'post',
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

      

</script>

@endsection