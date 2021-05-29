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
               <a href="{{ route('profile', ['id'=> $base->user->id ]) }}" class="card-text">{{$base->user->firstname.' '.$base->user->lastname}}</a>
 
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
                <button class="open-button btn btn-sm" data-toggle="modal" data-target="#popup">New Rate</button>
                 
                <!-- Pop-up -->
                <form action="/action_page.php">
                      <div id="popup" class="modal background" >
                            <div class="modal-dialog">
                                      <div class="modal-content">
                                      <div class="modal-header flex">
                                
                                      <div class="form-group row" style="margin-left: 20px;">
                                      <label for="colFormLabelSm" class="col-form-label col-form-label-Lg">Enter the new Rate :</label>
                          <div >
                            <input type="number" class="form-control form-control-Lg" id="classificationRate" placeholder="Enter the new Rate" style="margin-left: 20px;"  required>
                          </div>
                        </div>
                                            </div>
                                            <div class="modal-header flex">
                                
                                <div class="form-group row" style="margin-left: 20px;">
                                <label for="colFormLabelSm" class="col-form-label col-form-label-Lg">Enter Your name :</label>
                      <div style="margin-left: 18px;" >
                      <input type="text" class="form-control form-control-Lg"  id="userInfos" placeholder="Enter Your name" style="margin-left: 20px;"  required>
                      </div>
                      </div>
                                      </div>
                                    
                                      <div class="modal-footer flex">
                                      <button type="button" class="btn btn-primary" onclick="addResult({{$base->id}})">Submit</button>
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close </button>
                                            </div>
                                      </div>
                            </div>
                      </div>
                      </form>


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

           <a class="btn btn-primary btn-xl"  onclick="downloadBase({{$base->id}})" href="#">Download </a>
           @auth
           
           @if (auth()->user()->isInRole("admin") || auth()->user()->isOwner($base))
           <a class="btn btn-danger btn-xl" onclick="deleteBase({{$base->id}})" href="#">Delete </a>

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