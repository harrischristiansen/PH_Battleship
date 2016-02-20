@extends("app")

@section("customJS")
<script src="/js/Battleship.js"></script>
@stop

@section("content")

<div class="col-sm-3 col-md-2 sidebar">
	<h3 class="nav-header">BATTLESHIP</h3>
	<ul class="nav nav-sidebar" id="gamesList">
		<li><a href="#">No Active Games</a></li>
	</ul>
</div>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1>
		<span class="player1ID">Player 1</span> vs <span class="player2ID">Player 2</span>
		<div id="delayPicker">Move Delay:
			<select onchange="setDelay(this.value)">
				<option value="0.002">None</option>
				<option value="0.2">0.2 Seconds</option>
				<option value="1.0">1 Second</option>
				<option value="2.0">2 Seconds</option>
				<option value="4.0">4 Seconds</option>
			</select>
		</div>
	</h1>

	<div class="row">
		<div class="col-md-6">
			<div class="board-container">
				<h3><span class="player1ID">Player 1</span> - <span class="player1Wins"></span></h3>
				<table class="table table-bordered" id="player1">
					<thead>
						<tr>
							<th></th>
							<th>0</th>
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>
							<th>7</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>A</td>
							<td class="status-none">x</td>
							<td class="status-hit">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>B</td>
							<td class="status-none">x</td>
							<td class="status-hit">x</td>
							<td class="status-hit">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>C</td>
							<td class="status-hit">x</td>
							<td class="status-none">x</td>
							<td class="status-hit">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>D</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>E</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>F</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-miss">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>G</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-miss">x</td>
							<td class="status-miss">x</td>
						</tr>
						<tr>
							<td>H</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-miss">x</td>
							<td class="status-none">x</td>
							<td class="status-miss">x</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-6">
			<div class="board-container">
				<h3><span class="player2ID">Player 2</span> - <span class="player2Wins"></span></h3>
				<table class="table table-bordered" id="player2">
					<thead>
						<tr>
							<th></th>
							<th>0</th>
							<th>1</th>
							<th>2</th>
							<th>3</th>
							<th>4</th>
							<th>5</th>
							<th>6</th>
							<th>7</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>A</td>
							<td class="status-none">x</td>
							<td class="status-hit">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>B</td>
							<td class="status-none">x</td>
							<td class="status-hit">x</td>
							<td class="status-hit">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>C</td>
							<td class="status-hit">x</td>
							<td class="status-none">x</td>
							<td class="status-hit">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>D</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>E</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>F</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-miss">x</td>
							<td class="status-none">x</td>
						</tr>
						<tr>
							<td>G</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-miss">x</td>
							<td class="status-miss">x</td>
						</tr>
						<tr>
							<td>H</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-none">x</td>
							<td class="status-miss">x</td>
							<td class="status-none">x</td>
							<td class="status-miss">x</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
	</div>

@stop