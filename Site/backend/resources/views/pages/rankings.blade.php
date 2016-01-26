@extends("app")

@section("content")
<h1>Rankings</h1>
<table class="table table-bordered" >
<thead>
  <tr>
     <th>name</th>
     <th>games</th>
     <th>wins</th>
     <th>win percent</th>
     <th>edit, reset, delete</th>
  </tr>
</thead>
@foreach ($rankings as $team)
    <tr>
<!--     	<td>{{$team['id']}}</td> -->
        <td>{{$team['abb']}}: {{$team['name']}}</td>
    	<td>{{$team['games']}}</td>
    	<td>{{$team['wins']}}</td>
        <td>{{$team['win_percent']*100}}%</td>
    	<td><a href="{{ URL::to('/edit-team', $team['id']) }}"> edit </a></td>
    </tr>
@endforeach
</table>
@stop