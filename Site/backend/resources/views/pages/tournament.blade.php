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
		<div class="panel-body form-horizontal">
			<div class="form-group">
			    <label for="gameMode" class="col-sm-2 control-label">Tournament Mode</label>
			    <div class="col-sm-10">
					<select id="gameMode" class="form-control" onchange="setTournamentMode(this.value)">
						<option value="NoChange" selected> - Select - </option>
						<option value="N">Normal</option>
						<option value="T">Tournament</option>
					</select>
			    </div>
			</div>
		</div>
	</div>
</div>

@stop