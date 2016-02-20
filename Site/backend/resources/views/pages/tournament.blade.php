@extends("app")

@section("customJS")
<script src="/js/BattleshipTournament.js"></script>
@stop

@section("content")

<div class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
	    	<h3 class="panel-title">Manage Tournament</h3>
		</div>
		<div class="panel-body">
			Tournament Mode:
			<select onchange="setTournamentMode(this.value)">
				<option value="N" selected> - Select - </option>
				<option value="N">Normal</option>
				<option value="T">Tournament</option>
			</select>
			<br>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</div>
	</div>
</div>

@stop