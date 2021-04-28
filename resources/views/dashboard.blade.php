@extends('app')

@section('content')

  <div class="container box">
   <h1 align="center" class="color-title">LIST OF DATABASES </h1><br />
   
   <div class="form-group">
    <input type="text focus" name="base_name" id="base_name" class="form-control input-lg" placeholder="Type a database name" />
    <div id="countryList">
    </div>
   </div>
   {{ csrf_field() }}

   <x-bases-list :bases="$bases"/>
 
  </div>




<script  type="text/javascript">

$('#base_name').keyup(function(){ 
  //document.getElementById(hide_part).style.display = none;
    
  $('#hide_part').empty();
        var query = $(this).val();
        
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
        


    });

</script>

@endsection



