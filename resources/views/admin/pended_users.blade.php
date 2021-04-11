@extends('app')

@section('content')

<h2 style="text-align:center; margin:6px">Users waiting for admission </h2>

<div class="d-flex justify-content-center">
    @csrf
    <div>
        @if ($pendedUsers->count() > 0)
    @foreach ($pendedUsers as $user)
         <div id="{{'div'.$user->id}}" class="row">
            <div class="col p-2"> {{$user->lastname.' '.$user->lastname}}</div>
            <div class="col p-2">{{$user->created_at->diffForHumans()}}</div>
            <div class="col p-2"><button  onclick="approve(this.value)" value="{{$user->id}}" class="btn btn-success">Approve</button></div>
            <div class="col p-2"><button  onclick="reject(this.value)" value="{{$user->id}}" class="btn btn-danger">Reject</button></div>
            
        </div>
    @endforeach

    @else
        <p>All users were admitted</p>
    @endif
    </div>
</div>
<script>
  
    function approve(userId){
            //var userId = $('#approveUser').val();
            var CSRF_TOKEN =$('[name="_token"]').val();
            $.ajax({
                url:'/approve-user',
                type:'post',
                dataType: 'json',
                 data: {'userId': userId, _token: CSRF_TOKEN},
                success: function (result, status) {

                    console.log(result)
                    $('#div'+userId).remove();
                    //location.reload()
                },
                error : function(result, status, error){
                    console.log(error)
                    console.log(CSRF_TOKEN)

                }
            
            })
           
        }

        function reject(userId){
           // var userId = $('#rejectUser').val();
            var CSRF_TOKEN =$('[name="_token"]').val();
            $.ajax({
                url:'/reject-user',
                type:'post',
                dataType: 'json',
                 data: {'userId': userId, _token: CSRF_TOKEN},
                success: function (result, status) {
                    $('#div'+userId).remove();
                    console.log(result)
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

