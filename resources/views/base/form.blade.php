@extends('app')

@section('content')


<div class="container mb-5 " style="width: 900px;">
      <div class="card login-card" style="    padding-bottom: 43px;" >
<div class="w-75" style="margin-top: 61px;margin-left: 109px;">

    {{-- @if(isset(Auth::user()->email))
    <script>window.location="/dashboard";</script>
@endif --}}

@if ($message = Session::get('status'))
<div class="alert alert-danger alert-block">
<button type="button" class="close" data-dismiss="alert">×</button>
<strong>{{ $message }}</strong>
</div>
@endif

<form method="post" action="{{route('newBase')}}" enctype="multipart/form-data" style="max-width: 100%;">
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
        <select style="    min-height: 51px;" class="form-control @error('apptype') border border-danger @enderror" value="{{old('apptype')}}" id="apptype" name="apptype" placeholder="Enter your application type">
            <option class="p-1" value="0" >Select an application type</option>
            @foreach ($applicationTypes as $item)
            <option class="p-1" value={{$item->id}} >{{$item->application_name}}</option>
            @endforeach
        </select>
        <button class="btn btn-sm btn-secondary mt-1 button2 btn-primary" id="newAppBtn">Add a new type</button>
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
    <button class="btn btn-sm btn-primary  button2" id="submitApp">Confirm</label>
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
        <textarea type="text" class=" form-control @error('references') border border-danger @enderror" value="{{old('references')}}" id="references" name="references" placeholder="Enter your references"></textarea>
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
        <label for="indexImg">Upload an index image of the database</label>
        <input type="file" class="form-control @error('indexImg') border border-danger @enderror" style="width: 100%;   height: 100%;" value="{{old('indexImg')}}" id="indexImg" name="indexImg">
        @error('indexImg')
        
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div>

    <div class="form-group">
        <input type="hidden" name="db_file_name" id="db_file_name"/>
        <label for="file">Upload the database zip file</label>

        <input type="file" data-url="/bases/upload" class="form-control" style="width: 100%;   height: 100%;" value="{{old('file')}}" id="file" name="file" placeholder="Select a file to upload">

        <span class="m-2 font-weight-light" id="loading"></span>
        <div id="progress" class="progress-bar form-group">&nbsp;</div>
        @error('file')
        
        <div class="text-danger mt-2 text-sm">
            {{$message}}
        </div>
        @enderror
    </div> 
    
    <div class="mt-2">
        <button type="submit" id="submitBtn" class="btn btn-md btn-primary button1" >Submit</button>
    </div>
  </form>
</div>
</div>
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
    });

    $("#submitBtn").prop('disabled',true);

    $('#progress').hide().css(
                    'width',
                    '0%'
                );

    
    $('#file').fileupload({
            dataType: 'json',
            maxChunkSize: 10000000,
            add: function (e, data) {
                $('#loading').text('Uploading...');
                $('#progress').hide().css(
                    'width',
                    '0%'
                );

                data.submit();
            },
            done: function (e, data) {
                $("#submitBtn").prop('disabled',false);
                $('#loading').text('File uploaded successfully');
                $('#db_file_name').val(data.result.path);
                $("#file").prop('disabled',true);
               
            }
            
        }); 
    
}).on('fileuploadprogressall', function (e, data) {
        
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress').show().css(
                'width',
                progress + '%'
            );
        });
  
    function submitApp(userId){
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