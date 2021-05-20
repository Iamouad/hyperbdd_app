<link rel="stylesheet" href="/css/login.css">




  
  


     <!-- Navbar -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <a class="navbar-brand" href="https://www-lisic.univ-littoral.fr/" target="_blank">
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
            <a class="nav-link"  target="_blank" style="color:white;" href="{{route('dashboard')}}">Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  target="_blank" style="color:white;" href="{{route('register')}}">Register</a>
          </li>
          <li class="nav-item">
          <li class="nav-item active">
            <a class="nav-link"  target="_blank" style="color:white;" href="{{route('login')}}">Login</a>
            <span class="sr-only">(current)</span>
          </li>
          @endguest

          @auth 
          
         <li>
            <a class="nav-link"   target="_blank" style="color:white;" href="{{route('dashboard')}}">Home
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link"   target="_blank" style="color:white;" href="{{route('dashboard')}}">Dashboard </a>
          </li> 

          @if (auth()->user()->isInRole("admin"))
          <div class="nav-item">
            <a class="nav-link "   target="_blank" style="color:white;" href="{{route('pending')}}">Pendings</a>
          </div>
          <div class="nav-item">
            <a class="nav-link "  target="_blank" style="color:white;" href="{{route('users')}}">Users</a>
          </div>
          @endif
          <div class="nav-item">
            <a class="nav-link" style="color:white; font-family:cursive; font-weight:bold" href="{{route('newBase')}}">NewDb</a>
          </div>
          <div class="nav-item">
            <a href="#" class="nav-link  text-uppercase " style="color:white;font-family:cursive; font-weight:bold; margin-left: 645px;">
                       
                                {{auth()->user()->lastname}} <span class="caret"></span>

                            </a>
                            <div class="navbar-nav nav-flex-icons" style="padding-left: 20px">
                             <div class="dropdown">
                               <img   src="{{asset('storage/'.auth()->user()->avatar_path)}}" style="width:32px; height:36px; position:absolute; margin-left: 400px; top:-34px; left:170px; border-radius:50%">
                                
                                <div class="dropdown-content"> 
                                
                                <li><a href="{{ route('profile') }}" style="color:white;font-family: Comic Sans MS ;">Profile</a></li>
                                </div>
                             </div>
                            </div>
        
        </div>
       @endauth

        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
        @auth 
        @if (!auth()->user()->isInRole("admin"))
        <div class="nav-item">
            <a class="nav-link"   target="_blank" style="color:white;" href="{{route('newBase')}}">NewDb</a>
          </div>
          @endif
          <div class="flex" style="color:white;" >
          <div class="nav-item">
        </div>


       <ul class="navbar-nav nav-flex-icons">
            <form action="{{route('logout')}}" method="post">
              @csrf
             
                <button type="submit"  target="_blank" class="btn btn-sm nav-link border border-light rounded " style="color:white;width: 105px; ">
                &nbsp;<img src="/images/sub.png" style=" height: 19px;  ">      </img> &nbsp;Logout &nbsp;</button>
              
            </form>
            @endauth

        </ul>

      </div>

    </div>
  </nav>
