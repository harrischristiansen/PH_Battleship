@extends("app")

@section("content")
<h1>Teams</h1>
<table class="table table-bordered" >
<thead>
  <tr>
     <th>id</th>
     <th>key</th>
     <th>name</th>
     <th>games</th>
     <th>wins</th>
     <th>edit, reset, delete</th>
  </tr>
</thead>
@foreach ($teams as $team)
    <tr>
    	<td>{{$team['id']}}</td>
    	<td>{{$team['team_key']}}</td>
    	<td>{{$team['name']}} ({{$team['abb']}}) </td>
    	<td>{{$team['games']}}</td>
    	<td>{{$team['wins']}}</td>
    	<td><a href="{{ URL::to('/edit-team', $team['id']) }}"> edit </a></td>
    </tr>
@endforeach
</table>
@stop