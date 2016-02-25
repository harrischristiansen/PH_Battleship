@extends("app")

@section("content")

<div class="titlePage row">
	<h1 class="titlePageTitle">Battleship</h1>
	<p class="titlePageSub">Leaderboard</p>
	<br><br><br>
	<div class="container">
		<div class="panel panel-default">
			<table class="table panel-body leaderboardTable">
				<thead>
					<tr><th>#</th><th>Team</th></tr>
				</thead>
				<tbody>
					@foreach ($rankings as $team)
					<tr><td>{{ array_search($team,$rankings)+1 }}</td><td>{{ $team['name'] }}</td></tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	setTimeout("location.reload(true);",20000);
</script>

@stop