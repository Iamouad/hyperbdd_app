@props(['bases' => $bases])

<div id=hide_part>
    @foreach($bases as $key=>$base)
    <section class="page-section clearfix" id="{{'section'.$base->id}}">
     <div class="container">
       <div class="intro">
         @if(++$key %2 != 0)
         <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="{{asset('storage/'.$base->index_img_path)}}" alt="">
         <div class="intro-text left-0 text-center bg-faded p-5 rounded btn" >            
         @else
         <img class="intro-img0 img-fluid mb-3 mb-lg-0 rounded" src="{{asset('storage/'.$base->index_img_path)}}" alt="">
         <div class="intro-text0 left-0 text-center bg-faded p-5 rounded btn" style="height: 346px;" >
         @endif
            <div onclick="window.location.href='{{'/bases/'.$base->id}}'">
           <h2 class="section-heading mb-4">
             <span class="section-heading-lower">{{$base->dbname}}</span>
           </h2>
 
           
           <ul class="no_bullets ">
             <li class="m-2 flex"><span class="badge p-2 mx-2 badge-primary">Creation date </span> <span>{{$base['created_at']->diffForHumans()}}</span>
             </li>
             <li class="m-2 flex"><span class="badge p-2 mx-2  badge-secondary">Application type </span> <span>{{$base->applicationType->application_name}}</span>
             </li>
             <li class="flex m-2"><span class="badge p-2 mx-2 badge-light">Number of images</span> <span> {{$base['nbimages']}} </span>
             </li>
             <li class=" flex m-2"><span class="badge p-2 mx-2 badge-dark">Number of downloads</span> <span id={{'downloads'.$base->id}}>{{$base['nb_downloads']}}</span>
             </li>
             <li  class=" flex m-2" > <span class="badge p-2 mx-2 badge-info">Description </span><span class="d-inline-block text-truncate" style="max-width: 250px;">{{$base['description']}}</span>
             </li>
         
           </ul>
            </div>
         
           <div class="intro-button mx-auto">
             <a class="btn btn-primary btn-lg" onclick="incrementDownload({{$base->id}})" href={{env('DO_REPO_LINK').$base->bdd_img_path}}>Download </a>
             @auth
             @if (auth()->user()->isInRole("admin") || auth()->user()->isOwner($base))
             <a class="btn btn-danger btn-lg" onclick="deleteBase({{$base->id}})" href="#">Delete </a>
            @endauth
            
 
            @endif
           </div>
         </div>
       </div>
     </div>
   </section>
   @endforeach
   {{-- Pagination --}}
 <div class="d-flex justify-content-center">
   {{ $bases->links() }}
 </div>
    </div>