@extends("app")

@section("content")

<div class="container">
	<h1>Create Team</h1>
	<div class="panel panel-default">
		<form method="post" action="/create-team" class="panel-body">
			{!! csrf_field() !!}
			<input type="text" name="teamName" id="teamName" placeholder="Team Name" class="form-control">
			<br>
			<input type="text" name="teamAbb" id="teamAbb" placeholder="Team Abbreviation" maxlength="4" class="form-control">
			<br>
			<input type="submit" value="Create Team" class="btn btn-primary">
		</form>
	</div>
</div>

@stop