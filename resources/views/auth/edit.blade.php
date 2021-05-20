       
       
@extends('app')

@section('content')


  
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <!-- <div class="container padd"> -->
    <div class="cont over-size">
      <div class="card login-card">

          
          <div>
            <div class="card-body ">
              <div class="brand-wrapper0" style="margin-left: 1px;margin-right: 10%;" class="content">
                <img src="images/3.jpg" alt="logo" class="logo" style="margin-left: 97%;">
              </div>
              <strong class="login-card-description plus text-uppercase" style="margin-left: -248px;">{{auth()->user()->lastname}} {{auth()->user()->firstname}} </strong><br>
              <!-- <form enctype="multipart/form-data" action="{{route('register')}}" method="POST">
                        <label>Update Profile Image</label>
                        <input type="file" name="avatar">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> 
                        <input type="submit" class="pull-right btn btn-sm btn-primary"> 
                     </form>  -->
            
              @if ($message = Session::get('status'))
              <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
              </div>
              @endif
          <form method="post" action="{{route('edit')}}" enctype="multipart/form-data" style="margin-left: auto; margin-right: auto;">
            @csrf    
          
             <div class="form-group width">
                <label for="avatar">Profile Picture</label>
                <input type="file" class="form-control @error('avatar') border border-danger @enderror"   id="avatar" name="avatar" placeholder="New profile image">
                @error('avatar')
                
                <div class="text-danger mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div>  
            <div class="form-group width">
              <label for="phone_number" class="ecrit">Phone number :</label>
              <input type="text" class="form-control @error('phone_number') border border-danger @enderror" value="{{auth()->user()->phone_number}}" id="phone_number" name="phone_number" placeholder="Enter your phone number">
              @error('phone_number')
              <div class="text-danger mt-2 text-sm">
                  {{$message}}
              </div>
              @enderror
              <div class="form-group">
              <label for="fax" class="ecrit">Fax :</label>
              <input type="text" class="form-control @error('fax') border border-danger @enderror" value="{{auth()->user()->fax}}" id="fax" name="fax" placeholder="Enter your fax">
              @error('fax')
              <div class="text-danger mt-2 text-sm">
                  {{$message}}
              </div>
              @enderror
          
              <div class="form-group">
              <label for="academic_career" class="ecrit">Academic career :</label>
              <textarea class="form-control"  id="academic_career" name="academic_career" rows="4" cols="50" >  {{auth()->user()->academic_career}}</textarea>
               @error('academic_career')
              <div class="text-danger mt-2 text-sm">
                  {{$message}}
              </div>
              @enderror
              <div class="form-group">
              <label for="description" class="ecrit">Research topics :</label>
              <textarea class="form-control" id="description" name="description" rows="4" cols="50">  {{auth()->user()->description}}</textarea>
              @error('description')
              <div class="text-danger mt-2 text-sm">
                  {{$message}}
              </div>
              @enderror
            <!-- <div class="form-group">
                <label for="avatar">Profile Picture :</label>
                <input type="file" class="form-control @error('avatar') border border-danger @enderror" style="width: 100%;   height: 100%;" value="{{old('avatar')}}" id="indexImg" name="indexImg">
                @error('avatar')
                
                <div class="text-danger mt-2 text-sm">
                    {{$message}}
                </div>
                @enderror
            </div> -->
    
    <button type="submit" class="btn btn-primary left-push">Submit</button>
    </form>
    </div>
    </div> 
</div>
  </main>


  @endsection