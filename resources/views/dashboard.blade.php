@extends('app')

@section('content')
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
                    <th scope="col">Application type</th>
                    <th scope="col">Creation date</th>

                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($bases as $base)
                    <tr>
                        <td>{{$base->dbname}}</td>
                        <td>{{$base->nbimages}}</td>
                        <td>{{$base->applicationType->application_name}}</td>
                    
                        <td>{{$base->created_at->diffForHumans()}}</td>
                        <td><a href={{env('DO_REPO_LINK').$base->bdd_img_path}} target="_blank" rel="noopener noreferrer">Download </a></td>
                    </tr>
                    @endforeach
                 
                 
                </tbody>
              </table>
       
    
 
</div>    



@endsection