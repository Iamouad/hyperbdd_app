@extends('app')

@section('content')
<h1 style="text-align:center; margin:6px;">Users & roles</h1>

    <div  class="d-flex justify-content-center">
      @csrf
        <div>
          @if ($users->count() > 0)
          <table class="table table-responsive text-white">
            <thead class="thead">
              <tr>
                <th scope="col">Full name</th>
                <th scope="col">Email</th>
                <th scope="col">Join date</th>
                <th scope="col">Role</th>
            
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->lastname.' '.$user->lastname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>
                    <select class="form-control" name="role" id="{{'role'.$user->id}}" onchange="roleChanged({{$user->id}}, this.value)">
                        @foreach ($roles as $role)
                            <option value="{{$role->id}}" 
                         {{$role->id === $user->role->id ? "selected":""}}  >{{$role->label}}</option>
                        @endforeach
                    </select></td>
                  </tr>
                @endforeach
              
              
            </tbody>
          </table>
          @else
          <p>You are the only user of this app</p>
          @endif
          
        </div>
    </div>
    <script>
      function roleChanged(userId, roleId) {
        var CSRF_TOKEN =$('[name="_token"]').val();
        console.log(CSRF_TOKEN)
            $.ajax({
                url:'/change-permission',
                type:'post',
                dataType: 'json',
                 data: {'userId': userId, 'roleId': roleId , _token: CSRF_TOKEN},
                success: function (result, status) {

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