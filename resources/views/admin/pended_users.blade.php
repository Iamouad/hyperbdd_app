@extends('app')

@section('content')
<h2 class="section-heading" style="margin-bottom: 66px;">
           <span class="section-heading-lower text-primary centrer">Users waiting for admission</span>
         </h2>

<div class="d-flex justify-content-center">
    @csrf
    <div>
    
        @if ($pendedUsers->count() > 0)
        <table class="table table-responsive text-white">
            <thead class="thead">
              <tr>
                <th class="text-center" scope="col">Full name</th>
                <th class="text-center" scope="col">Email</th>
                <th class="text-center" scope="col">Join date</th>
                <th class="text-center" scope="col">Approve</th>
                <th class="text-center" scope="col">Reject</th>
            
              </tr>
            </thead>
            <tbody>
    @foreach ($pendedUsers as $user)
         <div class="row">
         <tr id="{{'div'.$user->id}}" >
                    <td style="padding-top: 24px;">{{$user->lastname.' '.$user->firstname}}</td>
                    <td style="padding-top: 24px;">{{$user->email}}</td>
                    <td style="padding-top: 24px;">{{$user->created_at->diffForHumans()}}</td>
                    <td>
            <div class="col p-2" style="color:white"><button  onclick="approve(this.value)" value="{{$user->id}}" class="btn btn-info">Approve</button></div>
            </td>
            <td>
            <div class="col p-2" style="color:white"><button  onclick="reject(this.value)" value="{{$user->id}}" class="btn btn-info">Reject</button></div>
            </td>
                    
        </div>
    @endforeach
    </tbody>
          </table>









    @else
        <p>All users were admitted</p>
    @endif
    </div>
</div>
<script>
  
    function approve(userId){
            var CSRF_TOKEN =$('[name="_token"]').val();
            $('#div'+userId).remove();
            $.ajax({
                url:'/approve-user',
                type:'post',
                dataType: 'json',
                 data: {'userId': userId, _token: CSRF_TOKEN},
                success: function (result, status) {
                    
                },
                error : function(result, status, error){
                    console.log(CSRF_TOKEN)

                }
            
            })
           
        }

        function reject(userId){
            var CSRF_TOKEN =$('[name="_token"]').val();
            $('#div'+userId).remove();
            $.ajax({
                url:'/reject-user',
                type:'post',
                dataType: 'json',
                 data: {'userId': userId, _token: CSRF_TOKEN},
                success: function (result, status) {
                    
                },
                error : function(result, status, error){
                    console.log(error)

                }
            
            })
           
        }

</script>
@endsection

