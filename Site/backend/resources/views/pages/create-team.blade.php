@extends("app")

@section("content")
<h1>Create Team</h1>

<form method="post" action="/create-team">
		{!! csrf_field() !!}
		<input type="textfield" name="teamKey" id="teamKey" placeholder="teamKey">
		<br>
		<input type="textfield" name="teamName" id="teamName" placeholder="teamName">
		<br>
		<input type="textfield" name="teamAbb" id="teamAbb" placeholder="teamAbb">
		<br>
		<input type="submit" value="Create Team">
	</form>

@stop