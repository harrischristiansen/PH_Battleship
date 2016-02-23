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
						<option value="R">Random</option>
						<option value="T">Tournament</option>
					</select>
			    </div>
			</div>
			<div class="form-group">
			    <label for="gameMode" class="col-sm-2 control-label">Default Move Delay</label>
			    <div class="col-sm-10">
					<select id="gameMode" class="form-control" onchange="setMasterDelay(this.value)">
						<option value="NoChange" selected> - Select - </option>
						<option value="0.002">None</option>
						<option value="0.2">0.2 Seconds</option>
						<option value="1.0">1 Second</option>
						<option value="2.0">2 Seconds</option>
						<option value="4.0">4 Seconds</option>
					</select>
			    </div>
			</div>
		</div>
	</div>
</div>

@stop