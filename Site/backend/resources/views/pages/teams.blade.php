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
  </tr>
</thead>
@foreach ($teams as $team)
    <tr>
    	<td>{{$team['id']}}</td>
    	<td>{{$team['team_key']}}</td>
    	<td>{{$team['name']}} ({{$team['abb']}}) </td>
    	<td>{{$team['games']}}</td>
    	<td>{{$team['wins']}}</td>
    </tr>
@endforeach
</table>
@stop