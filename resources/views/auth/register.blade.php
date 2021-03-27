@extends('app')

@section('content')
<div class="w-75">
<form method="post" action="{{route('register')}}">
    @csrf
    <div class="form-group">
        <label for="first_name">First name</label>
        <input type="text" class="form-control @error('username') border border-danger @enderror" value="{{old('first_name')}}" id="first_name" name="first_name" placeholder="Enter your first name">
        @error('first_name')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="last_name">Last name</label>
        <input type="text" class="form-control @error('last_name') border border-danger @enderror" value="{{old('last_name')}}" id="last_name" name="last_name" placeholder="Enter your last name">
        @error('last_name')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control @error('email') border border-danger @enderror" value="{{old('email')}}" id="email" name="email" placeholder="Enter email">
      @error('email')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control @error('password') border border-danger @enderror" name="password" id="password" placeholder="Password">
      @error('password')
      <div class="text-danger mt-2 text-sm">
          {{$message}}
      </div>
      @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">Password confirmation</label>
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm you password">
    </div>
    <div class="mt-2">
        <button type="submit" class="btn btn-md btn-primary">Submit</button>
    </div>
  </form>
</div>
@endsection