@extends('app')

@section('content')

<main >

@foreach($infos as $info)
   <section class="page-section clearfix">
    <div class="container">
      <div class="intro">
        <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="images/intro.jpg" alt="">
        <div class="intro-text left-0 text-center bg-faded p-5 rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-lower">Data Base name</span>
          </h2>
          <ul class="no_bullets ">
            <li class="flex"><p class="left00">Picture's number : </p> <p> {{$info['id']}} </p>
            </li>
            <li class=" flex"><p class="left01">Reference :</p> <p>{{$info['firstname']}}</p>
            </li>
            <li  class=" flex" > <p class="left02">Description : </p><p>{{$info['email']}}</p>
            </li>
        
          </ul>

          <div class="intro-button mx-auto">
            <a class="btn btn-primary btn-xl" href="#">Link!</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endforeach

   <section class="page-section clearfix">
    <div class="container">
      <div class="intro">
        <img class="left img-fluid mb-3 mb-lg-0 rounded" src="images/intro.jpg" alt="">
        <div class="intro-text left-0 text-center bg-faded p-5 rounded right">
          <h2 class="section-heading mb-4">
            <span class="section-heading-upper">Fresh Coffee</span>
            <span class="section-heading-lower">Worth Drinking</span>
          </h2>
          <ul class="list-group" >
    <li class="list-group-item">Active item</li>
    <li class="list-group-item">Second item</li>
    <li class="list-group-item">Third item</li>
  </ul>
        </div>
      </div>
    </div>
  </section>


  <section class="page-section clearfix">
    <div class="container">
      <div class="intro">
        <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="images/intro.jpg" alt="">
        <div class="intro-text left-0 text-center bg-faded p-5 rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-upper">Fresh Coffee</span>
            <span class="section-heading-lower">Worth Drinking</span>
          </h2>
          <p class="mb-3">Every cup of our quality artisan coffee starts with locally sourced, hand picked ingredients. Once you try it, our coffee will be a blissful addition to your everyday morning routine - we guarantee it!
          </p>
          <div class="intro-button mx-auto">
            <a class="btn btn-primary btn-xl" href="#">Visit Us Today!</a>
          </div>
        </div>
      </div>
    </div>
  </section>      
</main>


@endsection