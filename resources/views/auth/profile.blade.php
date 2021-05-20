@extends('app')



@section('content')
<main>
<main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="cont over-size">
      <div class="card login-card"> 
      <div class="card-body" >
        <div class="container">
            <div class="row"> 
                <div class="col-md-10 col-md-offset-1">
                    <img src="{{asset('storage/'.auth()->user()->avatar_path)}}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;"> 
                    <h2 class="nav-link  text-uppercase  " >{{auth()->user()->lastname}} {{auth()->user()->firstname}}</h2>
                    <li class="flex"><p class="left00 ">Phone number : </p> <p> {{$user['phone_number']}} </p>
                      </li>
                        <li  class=" flex" > <p class="left02">Fax : </p><p>{{$user['fax']}}</p>
                        </li>
                </div>
            </div>   
        <div>
            <section class="page-section clearfix">
            <p class="left02">Academic career : </p><p>{{$user['academic_career']}}</p>
           
           </section> 
        </div>
        <div>
           <section class="page-section clearfix">
            <p class="left02">Research topics : </p>
            <p>{{$user['description']}}</p>          
           </section> 
        
        </div>
        @if(auth()->user()->id == $user['id'])
        <a class="pull-right btn btn-sm btn-primary" style="font-size: 20px;padding: 14px 40px;" href="{{route('edit')}}">Edit </a>
        @endif
        
    </div> 
</div>
</main>

    
@endsection