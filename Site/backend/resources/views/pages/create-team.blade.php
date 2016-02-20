@extends("app")

@section("content")

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
	    	<h3 class="panel-title">Create Team</h3>
		</div>
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