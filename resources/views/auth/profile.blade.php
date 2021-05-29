@extends('app')



@section('content')
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0 mb-5">
    <div class="cont over-size ">
      <div class="card login-card"> 
      <div class="card-body" >
        <div class="container">
            <div class="row" > 
                <div class="col-md-12 col-md-offset-1 flex">
                    <div>
                    <img src="{{asset('storage/'.$user->avatar_path)}}" style="width:160px; height:160px; float:left; border-radius:50%; margin-right:25px;"> 
                    </div>
                    <div>
                    <h2 class="text-uppercase" style="font-family: cursive" >{{$user->lastname}} {{$user->firstname}}</h2>
                    <li class="flex"><p class="left00 ">Phone number : </p> <p> {{$user['phone_number']}} </p>
                      </li>
                        <li  class=" flex" > <p class="left02">Fax : </p><p>{{$user['fax']}}</p>
                        </li>
                        <li class=" flex"> <p class="left02" ><a href="{{'/bases/user/'.$user->id}}" target="_blank" rel="noopener noreferrer">Researches</a></p>
                        </li>
                    </div>       
                </div>
            </div>   
        <div>
            <section class="page-section clearfix" style="margin-top:-10px">
            <p class="left02">Academic career : </p><p>{{$user['academic_career']}}</p>
           
           </section> 
        </div>
        <div>
           <section class="page-section clearfix" style="margin-top:-40px">
            <p class="left02">Research topics : </p>
            <p>{{$user['description']}}</p>          
           </section> 
        
        </div>
       
        @if(Auth::user())
        @if(Auth::user()->id == $user['id'])
        <div style="margin-top:-40px">
        <a class="pull-right btn btn-sm btn-primary mt-2" style="font-size: 20px;padding: 14px 40px;" href="{{route('edit')}}">Edit </a>
        </div>
        @endif
        @endif

        
        
    </div> 
</div>
</main>

    
@endsection