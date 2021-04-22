<link rel="stylesheet" href="/css/login.css">




   <!-- Navbar -->
   <nav id="navbar" class="fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
    <div class="container">

      <!-- Brand -->
      <!-- <img src="images/3.jpg" alt="logo" class="logo1"> -->

      <!-- Collapse -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Links -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">

        <!-- Left -->
        <ul class="navbar-nav mr-auto">
            <a class="nav-link" style="color:white" href="{{route('dashboard')}}">Home
            </a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" style="color:white" href="{{route('dashboard')}}">Dashboard </a>
          </li>
         


          @guest
          <li class="nav-item">
            <a class="nav-link" style="color:white" href="{{route('register')}}">Register</a>
          </li>
          <li class="nav-item">
          <li class="nav-item active">
            <a class="nav-link" style="color:white" href="{{route('login')}}">Login</a>
            <span class="sr-only">(current)</span>
          </li>
          @endguest

                  @auth    
          
          @if (auth()->user()->isInRole("admin"))
          <div class="nav-item">
            <a class="nav-link " style="color:white" href="{{route('pending')}}">Pendings</a>
          </div>
          <div class="nav-item">
            <a class="nav-link " style="color:white" href="{{route('users')}}">Users</a>
          </div>
          @endif

          <div class="nav-item">
            <a class="nav-link" style="color:white" href="{{route('newBase')}}">Add a new Db</a>
          </div>
          <div class="nav-item">
            <a class="nav-link  text-uppercase " style="color:white; margin-left: 545px;" href="#">{{auth()->user()->lastname}}</a>
        </div>

         <!-- Right -->
         <ul class="navbar-nav nav-flex-icons" style="padding-left: 20px">
        

        <!-- <li class="nav-item">
           <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded"
             target="_blank">
             
            &nbsp;<img src="img/slides/sub.png" style=" height: 19px; width: 20px;">      </img> &nbsp;S'identifier &nbsp;
           </a>
         </li> -->
       </ul>

       <ul class="navbar-nav nav-flex-icons">
            <form action="{{route('logout')}}" method="post">
              @csrf
                <button type="submit" class=" button nav-link border border-light rounded " style="color:white">
                &nbsp;<img src="/images/sub.png" style=" height: 19px; width: 20px;">      </img> &nbsp;Logout &nbsp;</button>
            </form>
            </ul>
        
          @endauth




        </ul>

        <!-- Right -->
        <ul class="navbar-nav nav-flex-icons">
        

         <!-- <li class="nav-item">
            <a href="https://github.com/mdbootstrap/bootstrap-material-design" class="nav-link border border-light rounded"
              target="_blank">
              
             &nbsp;<img src="img/slides/sub.png" style=" height: 19px; width: 20px;">      </img> &nbsp;S'identifier &nbsp;
            </a>
          </li> -->
        </ul>

      </div>

    </div>
  </nav>
  <!-- Navbar -->


  


    
