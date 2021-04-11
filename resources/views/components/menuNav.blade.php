<div class="d-flex justify-content-center bg-primary p-2">
    <div class="nav-item active">
      <a class="nav-link text-dark font-weight-bold" href="#">Home <span class="sr-only">(current)</span></a>
    </div>
    <div class="nav-item">
      <a class="nav-link text-dark font-weight-bold" href="{{route('dashboard')}}">Dashboard</a>
    </div>

    @guest
    <div class="nav-item">
      <a class="nav-link text-dark" href="{{route('register')}}">Register</a>
    </div>
     <div class="nav-item">
      <a class="nav-link text-dark font-weight-bold" href="{{route('login')}}">Login</a>
    </div>  
    @endguest  

    @auth    
    <div class="nav-item">
      <a class="nav-link text-dark text-uppercase font-weight-bold" href="#">{{auth()->user()->lastname}}</a>
  </div>
  @if (auth()->user()->isInRole("admin"))
  <div class="nav-item">
    <a class="nav-link text-dark font-weight-bold" href="#">Pendings</a>
  </div>
  <div class="nav-item">
    <a class="nav-link text-dark font-weight-bold" href="#">Users</a>
  </div>
  @endif
 
  <div class="nav-item">
    <form action="{{route('logout')}}" method="post">
      @csrf
       <button type="submit" class="text-dark font-weight-bold p-2 border-0 btn">Logout</button>
   </form>
  </div>

  @endauth
    
</div>