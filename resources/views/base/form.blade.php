@extends('app')

@section('content')
<div class="w-75">

    {{-- @if(isset(Auth::user()->email))
    <script>window.location="/dashboard";</script>
@endif --}}

@if ($message = Session::get('status'))
<div class="alert alert-danger alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>{{ $message }}</strong>
</div>
@endif

<form method="post" action="{{route('newBase')}}" enctype="multipart/form-data">
    @csrf    
    <div class="form-group">
        <label for="dbname">Database name</label>
        <input type="text" class="form-control @error('dbname') border border-danger @enderror" value="{{old('dbname')}}" id="dbname" name="dbname" placeholder="Enter your database name">
        @error('dbname')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>
    <div class="form-group">
        <label for="apptype">Application type</label>
        <select class="form-control @error('apptype') border border-danger @enderror" value="{{old('apptype')}}" id="apptype" name="apptype" placeholder="Enter your application type">
            <option class="p-1" value="0" >Select an application type</option>
            @foreach ($applicationTypes as $item)
            <option class="p-1" value={{$item->id}} >{{$item->application_name}}</option>
            @endforeach
        </select>
        <button class="btn btn-sm btn-secondary mt-1" id="newAppBtn">Add a new type</button>
        @error('apptype')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>


    <div class="form-group row" id="divApp">
    <div class="col-sm-6">
        <input type="text" id="newApp" class="form-control" placeholder="Application type">
    </div>
    <button class="btn btn-sm btn-primary" id="submitApp">Confirm</label>
    </div>
    

    <div class="form-group">
        <label for="nbimages">Number of images</label>
        <input type="number" class="form-control @error('nbimages') border border-danger @enderror" value="{{old('nbimages')}}" id="nbimages" name="nbimages" placeholder="Enter the number of images">
        @error('nbimages')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="references">References</label>
        <textarea type="text" class="form-control @error('references') border border-danger @enderror" value="{{old('references')}}" id="references" name="references" placeholder="Enter your references"></textarea>
        @error('references')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="classification_rate">Classification rate</label>
        <input type="number" class="form-control @error('classification_rate') border border-danger @enderror" value="{{old('classification_rate')}}" id="classification_rate" name="classification_rate" placeholder="Enter your classification rate">
        @error('classification_rate')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea type="text" class="form-control @error('description') border border-danger @enderror" value="{{old('description')}}" id="description" name="description" placeholder="Describe your work"></textarea>
        @error('description')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <label for="file">Upload a file</label>
        <input type="file" class="form-control @error('file') border border-danger @enderror" value="{{old('file')}}" id="file" name="file" placeholder="Select a file to upload">
        @error('file')
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>
    
    <div class="mt-2">
        <button type="submit" class="btn btn-md btn-primary">Submit</button>
    </div>
  </form>
</div>

<script>

$(document).ready(function(){
    $('#divApp').hide();
    $('#newAppBtn').click(function(e) {
        e.preventDefault();
        $('#divApp').show();
    });
    $('#submitApp').click(function(e) {
        e.preventDefault();
        submitApp();
        $('#divApp').hide();
    })
})
  
    function submitApp(userId){
            //var userId = $('#approveUser').val();
            var CSRF_TOKEN =$('[name="_token"]').val();
            var newApp =$('#newApp').val();

            $.ajax({
                url:'/add-app-type',
                type:'post',
                dataType: 'json',
                 data: {'appName': newApp, _token: CSRF_TOKEN},
                success: function (result, status) {

                    console.log('result', result)
                    $("#apptype").append(new Option(newApp, result.data.id));

                    //location.reload()
                },
                error : function(result, status, error){
                    console.log(error)
                    console.log(CSRF_TOKEN)

                }
            
            })

           
        }


</script>
@endsection