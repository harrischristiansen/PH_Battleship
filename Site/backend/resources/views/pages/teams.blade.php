@extends("app")

@section("content")
<div class="container">
	<h1>Teams</h1>
	<div class="panel panel-default">
		<table class="table table-bordered panel-body" >
		<thead>
			<tr>
				<th>key</th>
				<th>name</th>
				<th>games</th>
				<th>edit, reset, delete</th>
			</tr>
		</thead>
		@foreach ($teams as $team)
		    <tr>
		    	<td>{{$team['team_key']}}</td>
		    	<td>{{$team['abb']}}: {{$team['name']}}</td>
		    	<td>{{$team['games']}}</td>
		    	<td><a href="{{ URL::to('/edit-team', $team['id']) }}"> edit </a></td>
		    </tr>
		@endforeach
		</table>
	</div>
</div>
@stop