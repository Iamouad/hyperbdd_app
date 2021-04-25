@extends('app')

@section('content')

  <div class="container box">
   <h1 align="center" class="color-title">LIST OF DATA BASES </h1><br />
   
   <div class="form-group">
    <input type="text" name="country_name" id="country_name" onclick="javascript:afficher_cacher('hide_part');" class="form-control input-lg" placeholder="Enter Base Name" />
    <div id="countryList">
    </div>
   </div>
   {{ csrf_field() }}

   <div id=hide_part>
   @foreach($bases as $key=>$bas)
   <section class="page-section clearfix">
    <div class="container">
      <div class="intro">
        @if(++$key %2 != 0)
        <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="{{asset('storage/'.$bas->index_img_path)}}" alt="">
        <div class="intro-text left-0 text-center bg-faded p-5 rounded">            
        @else
        <img class="intro-img0 img-fluid mb-3 mb-lg-0 rounded" src="{{asset('storage/'.$bas->index_img_path)}}" alt="">
        <div class="intro-text0 left-0 text-center bg-faded p-5 rounded">
        @endif
      
          <h2 class="section-heading mb-4">
            <span class="section-heading-lower">{{$bas->dbname}}</span>
          </h2>

          
          <ul class="no_bullets ">
            <li class=" flex"><p class="left01">Creation date : </p> <p>{{$bas['created_at']->diffForHumans()}}</p>
            </li>
            <li class=" flex"><p class="left01">Application type : </p> <p>{{$bas->applicationType->application_name}}</p>
            </li>
            <li class="flex"><p class="left00">Number of images : </p> <p> {{$bas['nbimages']}} </p>
            </li>
            
            <li  class=" flex" > <p class="left02">Description : </p><p>{{$bas['description']}}</p>
            </li>
        
          </ul>
          <div class="intro-button mx-auto">
            <a class="btn btn-primary btn-xl" href={{env('DO_REPO_LINK').$bas->bdd_img_path}}>Download </a>
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

  
  </div>




<script  type="text/javascript">

function afficher_cacher(id)
{
    
    document.getElementById(id).style.visibility="hidden";
    return true;
}

$(document).ready(function(){

 $('#country_name').keyup(function(){ 
  //document.getElementById(hide_part).style.display = none;
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('list.action') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#countryList').fadeIn();  
                    $('#countryList').html(data);
          }
         });
        }

    });

    $(document).on('click', 'li', function(){  
        $('#country_name').val($(this).text());  
        $('#countryList').fadeOut();  
    });  

});
</script>

@endsection



