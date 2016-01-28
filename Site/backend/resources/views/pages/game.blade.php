@extends("app")

@section("customJS")
<script src="/js/Battleship.js"></script>
@stop

@section("content")

<div class="col-sm-3 col-md-2 sidebar">
	<ul class="nav nav-sidebar" id="gamesList">
		<li><a href="#">Game 1</a></li>
		<li><a href="#">Game 2</a></li>
		<li><a href="#">Game 3</a></li>
		<li><a href="#">Game 4</a></li>
		<li><a href="#">Game 5</a></li>
		<li><a href="#">Game 6</a></li>
		<li><a href="#">Game 7</a></li>
		<li><a href="#">Game 8</a></li>
		<li><a href="#">Game 9</a></li>
		<li><a href="#">Game 10</a></li>
		<li><a href="#">Game 11</a></li>
		<li><a href="#">Game 12</a></li>
		<li><a href="#">Game 13</a></li>
		<li><a href="#">Game 14</a></li>
		<li><a href="#">Game 15</a></li>
		<li><a href="#">Game 16</a></li>
		<li><a href="#">Game 17</a></li>
		<li><a href="#">Game 18</a></li>
		<li><a href="#">Game 19</a></li>
		<li><a href="#">Game 20</a></li>
	</ul>
	<br>
</div>

<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1>Game ## - X vs Y</h1>
	
	<table class="table table-bordered" style="float: left; width: 49%;" id="player1">
		<thead>
			<tr>
				<th>Player 1</th>
				<th>A</th>
				<th>B</th>
				<th>C</th>
				<th>D</th>
				<th>E</th>
				<th>F</th>
				<th>G</th>
				<th>H</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>2</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>3</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>4</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>5</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>6</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>7</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>8</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
		</tbody>
	</table>
	
	<table class="table table-bordered" style="width: 49%; float: right;" id="player2">
		<thead>
			<tr>
				<th>Player 2</th>
				<th>A</th>
				<th>B</th>
				<th>C</th>
				<th>D</th>
				<th>E</th>
				<th>F</th>
				<th>G</th>
				<th>H</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>2</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>3</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>4</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>5</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>6</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>7</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
			<tr>
				<td>8</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
				<td>x</td>
			</tr>
		</tbody>
	</table>
</div>

@stop