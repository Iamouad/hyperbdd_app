
       
@extends('app')

@section('content')


  
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    
    <div class="cont">
      <div class="card login-card">

          
          <div>
            <div class="card-body ">
              <div class="brand-wrapper0" class="content">
                <img src="images/3.jpg" alt="logo" class="logo">
              </div>
              
              <strong class="login-card-description plus">Sign up :</strong><br>
              @if(isset(Auth::user()->email))
                <script>window.location="/dashboard";</script>
              @endif
              @if ($message = Session::get('status'))
              <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
              </div>
              @endif
<form method="post" action="{{route('register')}}" enctype="multipart/form-data" style="margin-left: auto; margin-right: auto;">
    @csrf    
    <div class="top-row" id="p1">
    <div class="form-group">
        <label for="firstname" class="ecrit">First name :</label>
        <input type="text" class="form-control @error('firstname') border border-danger @enderror" value="{{old('firstname')}}" id="firstname" name="firstname" placeholder="Enter your first name">
        @error('firstname')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="lastname" class="ecrit">Last name :</label>
        <input type="text" class="form-control @error('lastname') border border-danger @enderror" value="{{old('lastname')}}" id="lastname" name="lastname" placeholder="Enter your last name">
        @error('lastname')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>
    </div>
    <div class="form-group">
      <label for="email" class="ecrit">Email address :</label>
      <input type="email" class="form-control @error('email') border border-danger @enderror" value="{{old('email')}}" id="email" name="email" placeholder="Enter email">
      @error('email')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="password" class="ecrit">Password :</label>
      <input type="password" class="form-control @error('password') border border-danger @enderror" name="password" id="password" placeholder="Password">
      @error('password')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation" class="ecrit">Password confirmation :</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm you password">
    </div>
     <div class="form-group">
        <label for="avatar">Profile Picture</label>
        <input type="file" class="form-control @error('avatar') border border-danger @enderror" style="width: 100%;   height: 100%;" value="{{old('avatar')}}" id="avatar" name="avatar" placeholder="Enter your profile image">
        @error('avatar')
        
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
      <label for="phone_number" class="ecrit">Phone number :</label>
      <input type="text" class="form-control @error('phone_number') border border-danger @enderror" value="{{old('phone_number')}}" id="phone_number" name="phone_number" placeholder="Enter your phone number">
      @error('phone_number')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror
      <div class="form-group">
      <label for="fax" class="ecrit">Fax :</label>
      <input type="text" class="form-control @error('fax') border border-danger @enderror" value="{{old('fax')}}" id="fax" name="fax" placeholder="Enter your fax">
      @error('fax')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror
      <!-- <div class="form-group">
      <label for="birth_date" class="ecrit">Birth date :</label>
      <input type="text" class="form-control  @error('birth_date') border border-danger @enderror" value="{{old('birth_date')}}" id="birth_date" name="birth_date" placeholder="year-month-day">
      @error('birth_date')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror  -->
      <div class="form-group">
      <label for="academic_career" class="ecrit">Academic career :</label>
      <textarea type="text" class="form-control @error('academic_career') border border-danger @enderror" value="{{old('academic_career')}}" id="academic_career" name="academic_career" placeholder="Enter your academic career"></textarea>
      @error('academic_career')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror
      <div class="form-group">
      <label for="description" class="ecrit">Research topics :</label>
      <textarea type="text" class="form-control @error('description') border border-danger @enderror" value="{{old('description')}}" id="description" name="description" placeholder="Enter a description of your research topics"></textarea>
      @error('academic_careerr')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror  

    
    <button type="submit" class="btn btn-primary left-push">Submit</button>
    </form>
    </div>
    </div> 
</div>
  </main>


  @endsection