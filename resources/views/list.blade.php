<h1>memeber </h1>

<table>
    <tr>

        <td >name </td>
        <td> mail </td>
    </tr>
    @foreach($infos as $info)
    <tr>
        <td >{{$info['lastname']}} </td>
        <td> {{$info['email']}} </td>
    </tr>
    @endforeach
</table>    