<link rel="stylesheet" href="/css/login.css">




  
  


     <!-- Navbar -->
     <nav id="barnav" class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand" href="https://www-lisic.univ-littoral.fr/" >
      <img src="/images/logo.png" alt="logo" class="logo1 "> 
      </a>

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">

        @guest
        <li> 
            <a class="nav-link"   style="color:white;" href="{{route('dashboard')}}">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"   style="color:white;" href="{{route('register')}}">Register</a>
          </li>
          <li class="nav-item">
          <li class="nav-item active">
            <a class="nav-link"   style="color:white;" href="{{route('login')}}">Login</a>
            <span class="sr-only">(current)</span>
          </li>
          @endguest

          @auth 
          
         <li>
            <a class="nav-link"    style="color:white;" href="{{route('dashboard')}}">Home
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link"    style="color:white;" href="{{'/bases/user/'.Auth::user()->id}}">Dashboard </a>
          </li> 

          @if (auth()->user()->isInRole("admin"))
          <div class="nav-item">
            <a class="nav-link "    style="color:white;" href="{{route('pending')}}">Pendings</a>
          </div>
          <div class="nav-item">
            <a class="nav-link "   style="color:white;" href="{{route('users')}}">Users</a>
          </div>
         
          @endif
          <div class="nav-item">
            <a class="nav-link" style="color:white" href="{{route('newBase')}}">NewDb</a>
          </div>
          @endauth

        
       

        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
        @auth 
        <div class="nav-item">                
             <div class="dropdown">
               <a href="{{ route('profile', ['id'=> auth()->user()->id ])}}"><img   src="{{asset('storage/'.auth()->user()->avatar_path)}}" style="width:32px; height:36px;border-radius:50%"></a>
                                                      
            </div>

          </div>
         
        <div class="nav-item">
        <a href="{{ route('profile', ['id'=> auth()->user()->id ])}}" class="nav-link  text-uppercase " style="color:white">
                       
            {{auth()->user()->lastname}} <span class="caret"></span>

                </a>
               </div>
          


          <div class="flex" style="color:white;" >
          <div class="nav-item">
        </div>


       <ul class="navbar-nav nav-flex-icons">
            <form action="{{route('logout')}}" method="post">
              @csrf
             
                <button type="submit"   class="btn btn-sm nav-link border border-light rounded " style="color:white;width: 105px; ">
                &nbsp;<img src="/images/sub.png" style=" height: 19px;  ">      </img> &nbsp;Logout &nbsp;</button>
              
            </form>
            @endauth

        </ul>

      </div>

    </div>
  </nav>
