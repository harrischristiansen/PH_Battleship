@extends("app")

@section("content")
<div class="container">
	<h1>Rankings</h1>
	<div class="panel panel-default">
	<table class="table table-bordered panel-body" >
	<thead>
		<tr>
			<th>name</th>
			<th>games</th>
			<th>wins</th>
			<th>win percent</th>
		</tr>
	</thead>
	@foreach ($rankings as $team)
	    <tr>
	        <td>{{$team['abb']}}: {{$team['name']}}</td>
	    	<td>{{$team['games']}}</td>
	    	<td>{{$team['wins']}}</td>
	        <td>{{$team['win_percent']*100}}%</td>
	    </tr>
	@endforeach
	</table>
	</div>
</div>

<script>
	setTimeout("location.reload(true);",20000);
</script>

@stop