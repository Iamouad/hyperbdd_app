@extends('app')

@section('content')


<main > 
  @if ($base)

  <section class="page-section clearfix" id="{{'section'.$base->id}}">
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
               <a href="{{'/bases/user/'.$base->user->id}}" class="card-text">{{$base->user->firstname.' '.$base->user->lastname}}</a>
 
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
               <div>
                <button class="open-button btn btn-sm" onclick="openForm()">New Rate</button>
                 <div class="form-popup" id="myForm">
                   <form action="/action_page.php" class="form-container">
                     {{-- <h1>New rate</h1> --}}

                     <input type="number" placeholder="Enter the new Rate" id="classificationRate" required>
                     <input type="text" placeholder="Enter Your name" id="userInfos" required>
 
                     <button type="button" class="btn btn-sm" onclick="addResult({{$base->id}})">Submit</button>
                     <button type="button" class="btn btn-sm cancel" onclick="closeForm()">Close</button>
                   </form>
                 </div>
                </div>
              
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

      <div class="card card-space1" >
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

      <div class="card card-space1" >
        <div class="card-body">
          <h5 class="card-title">Top 5 classification Rates</h5>
          <ul  class="card-text">
          @foreach ($results as $result)
          <li class="list-group-item d-flex justify-content-around align-items-center">
            <span class="w-25 d-flex justify-content-start">{{$result->user_infos}}</span>
            <span class="badge badge-primary badge-lg badge-pill">{{$result->classification_rate.'%'}}</span>
            <span class="badge badge-secondary badge-lg badge-pill">{{Str::before($result->created_at, ' ')}}</span>

          </li>
          @endforeach
          </ul>

       </div>
      </div>
      <br>
    <br>
     
         
         
         <div class="intro-button mx-auto">
           <a class="btn btn-primary btn-lg"  onclick="downloadBase({{$base->id}})" href="#">Download </a>
           @auth
           
           @if (auth()->user()->isInRole("admin") || auth()->user()->isOwner($base))
           <a class="btn btn-danger btn-lg" onclick="deleteBase({{$base->id}})" href="#">Delete </a>

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
  
  function addResult(baseId){
          var CSRF_TOKEN =$('[name="_token"]').val();
          var userInfos = $('#userInfos').val();
          var classificationRate = $('#classificationRate').val();
          console.log(userInfos, classificationRate)
          $.ajax({
              url:'/add-result',
              type:'get',
              dataType: 'json',
               data: {'baseId': baseId, 'userInfos': userInfos,
                'classificationRate': classificationRate
                },
              success: function (result, status) {
                  //$('#downloads'+baseId).text(result.nbDownloads)
                  location.reload();
              },
              error : function(result, status, error){
                  console.log(error)
              }
          
          })
        }
         
  //     }
  //     function deleteBase(baseId){
  //         var CSRF_TOKEN =$('[name="_token"]').val();
  //         $.ajax({
  //             url:'/delete-base',
  //             type:'post',
  //             dataType: 'json',
  //              data: {'baseId': baseId, _token: CSRF_TOKEN},
  //             success: function (result, status) {
  //                 location.reload()
  //             },
  //             error : function(result, status, error){
  //                 console.log(error)
  //             }
          
  //         })
         
  //     }
  //     function changeWindow(baseId) {
  //       console.log(baseId, 'changeWindow')
  //       window.location.href='bases/'+baseId;
  //     }
      
</script>

@endsection