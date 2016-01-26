@extends("app")

@section("content")

<div class="titlePage">
	<p class="titlePageSub">Purdue Hackers</p>
	<h1 class="titlePageTitle">Battleship</h1>
	
	<form method="post" action="/login">
		{!! csrf_field() !!}
		<input type="password" name="password" id="password" placeholder="Password">
		<input type="submit" value="Sign In">
	</form>
	
</div>

@stop