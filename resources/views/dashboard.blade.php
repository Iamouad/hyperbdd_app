@extends('app')

@section('content')


<main >

@foreach($bases as $base)
   <section class="page-section clearfix">
    <div class="container">
      <div class="intro">
        <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="images/intro.jpg" alt="">
        <div class="intro-text left-0 text-center bg-faded p-5 rounded">
          <h2 class="section-heading mb-4">
            <span class="section-heading-lower">{{$base->dbname}}</span>
          </h2>

          
          <ul class="no_bullets ">
            <li class="flex"><p class="left00">Number of images : </p> <p> {{$base['nbimages']}} </p>
            </li>
            <li class=" flex"><p class="left01">Reference :</p> <p>{{$base['references']}}</p>
            </li>
            <li  class=" flex" > <p class="left02">Description : </p><p>{{$base['description']}}</p>
            </li>
        
          </ul>

          <div class="intro-button mx-auto">
            <a class="btn btn-primary btn-xl" href={{env('DO_REPO_LINK').$base->bdd_img_path}}>Download </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  @endforeach

  <!--
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

<h2 style="text-align:center; margin:12px">Dashboard</h2>

<div class="d-flex justify-content-between">
        {{-- <ul>
            @foreach ($bases as $base)
            <li>{{$base->dbname}}</li>
            @endforeach   
        </ul> --}}
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">Db name</th>
                    <th scope="col">Number of images</th>
                    <th scope="col">Creation date</th>

                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($bases as $base)
                    <tr>
                        <td>{{$base->dbname}}</td>
                        <td>{{$base->nbimages}}</td>
                        <td>{{$base->created_at->diffForHumans()}}</td>
                        <td><a href={{env('DO_REPO_LINK').$base->bdd_img_path}} target="_blank" rel="noopener noreferrer">Download </a></td>
                    </tr>
                    @endforeach
                 
                 
                </tbody>
              </table>
       
        --> 
 
</div>    




@endsection