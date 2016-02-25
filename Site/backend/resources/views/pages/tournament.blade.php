@extends("app")

@section("customJS")
<script src="/js/BattleshipTournament.js"></script>
@stop

@section("content")

<div class="container">
	<h1>Manage Tournament</h1>
	<div class="panel panel-default">
		<div class="panel-body form-horizontal">
			<div class="form-group">
			    <label for="gameMode" class="col-sm-2 control-label">Tournament Mode</label>
			    <div class="col-sm-9">
					<select id="gameMode" class="form-control" onchange="setTournamentMode(this.value)">
						<option value="NoChange" selected> - Select - </option>
						<option value="N">Normal</option>
						<option value="R">Random</option>
						<option value="T">Tournament</option>
					</select>
			    </div>
			    <div class="col-sm-1">
				    <button href="#" class="btn btn-danger" onclick="resetAll();">Reset</button>
			    </div>
			</div>
			<div class="form-group">
			    <label for="gameDelay" class="col-sm-2 control-label">Default Move Delay</label>
			    <div class="col-sm-10">
					<select id="gameDelay" class="form-control" onchange="setMasterDelay(this.value)">
						<option value="NoChange" selected> - Select - </option>
						<option value="0.002">None</option>
						<option value="0.2">0.2 Seconds</option>
						<option value="1.0">1 Second</option>
						<option value="2.0">2 Seconds</option>
						<option value="4.0">4 Seconds</option>
					</select>
			    </div>
			</div>
			<div class="form-group">
			    <label for="makePair" class="col-sm-2 control-label">Make Pair</label>
			    <div class="col-sm-9">
					<select id="makePair" class="form-control" multiple>
						@foreach ($teams as $team) {
						<option value="{{ $team->abb }}">{{ $team->abb }} - {{ $team->name }}</option>
						@endforeach
					</select>
					<div id="pairError" style="color: red;"></div>
			    </div>
			    <div class="col-sm-1">
				    <button href="#" class="btn btn-success" onclick="setPair();">Pair</button>
			    </div>
			</div>
			<div class="form-group">
				<table class="table table-condensed" style="width: 200px; margin-left: auto; margin-right: auto;">
					<thead style="font-weight: bold;">
						<tr><td>Pairs</td> <td></td></tr>
					</thead>
					<tbody id="pairsList"></tbody>
				</table>
			</div>
		</div>
	</div>
</div>

@stop