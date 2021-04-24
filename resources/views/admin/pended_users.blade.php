@extends('app')

@section('content')

<h2 style="text-align:center; margin:6px">Users waiting for admission </h2>

<div class="d-flex justify-content-center">
    @csrf
    <div>
    
        @if ($pendedUsers->count() > 0)
    @foreach ($pendedUsers as $user)
         <div id="{{'div'.$user->id}}" class="row">
            <div class="col p-2" style="font-weight:bold; font-family:cursive; color:white" > {{$user->lastname.' '.$user->firstname}}</div>
            <div class="col p-2" style="font-weight:bold; font-family:cursive; color:white">{{$user->created_at->diffForHumans()}}</div>
            <div class="col p-2" style="font-weight:bold; font-family:cursive; color:white"><button  onclick="approve(this.value)" value="{{$user->id}}" class="btn btn-success">Approve</button></div>
            <div class="col p-2" style="font-weight:bold; font-family:cursive; color:white"><button  onclick="reject(this.value)" value="{{$user->id}}" class="btn btn-danger">Reject</button></div>
            
        </div>
    @endforeach

    @else
        <p>All users were admitted</p>
    @endif
    </div>
</div>
<script>
  
    function approve(userId){
            var CSRF_TOKEN =$('[name="_token"]').val();
            $.ajax({
                url:'/approve-user',
                type:'post',
                dataType: 'json',
                 data: {'userId': userId, _token: CSRF_TOKEN},
                success: function (result, status) {
                    $('#div'+userId).remove();
                },
                error : function(result, status, error){
                    console.log(CSRF_TOKEN)

                }
            
            })
           
        }

        function reject(userId){
            var CSRF_TOKEN =$('[name="_token"]').val();
            $.ajax({
                url:'/reject-user',
                type:'post',
                dataType: 'json',
                 data: {'userId': userId, _token: CSRF_TOKEN},
                success: function (result, status) {
                    $('#div'+userId).remove();
                },
                error : function(result, status, error){
                    console.log(error)

                }
            
            })
           
        }

</script>
@endsection

