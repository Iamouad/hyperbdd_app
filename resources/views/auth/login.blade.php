@extends('app')

@section('content')
<div class="w-75">
<form action="{{route('login')}}" method="POST">
  @csrf
  @if(Session::has('status'))
  <p class="text-danger">{{session('status')}}</p>
  @endif
    <div class="form-group">
      <label for="email">Email address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <div class="form-check">
      <input type="checkbox" class="form-check-input" id="remember" name="remember">
      <label class="form-check-label" for="remember">Remember me</label>
    </div>
    <div class="mt-2">
        <button type="submit" class="btn btn-md btn-primary">Sign-in</button>
    </div>
  </form>
</div>
@endsection