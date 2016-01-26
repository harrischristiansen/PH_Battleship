@extends("app")

@section("content")

<div class="panel panel-default">
	<div class="panel-heading">
    	<h3 class="panel-title">Team Detail - {{ $team['name'] }}</h3>
	</div>
	<form method="post" action="/edit-team/{{$team['id']}}" class="panel-body">
		{!! csrf_field() !!}
		<input type="text" name="teamName" id="teamName" value="{{$team['name']}}" placeholder="Team Name" class="form-control">
        <br>
        <input type="text" name="teamAbb" id="teamAbb" value="{{$team['abb']}}" placeholder="Team Abbreviation" class="form-control">
        
        <div class="checkbox"><label>
			<input type="checkbox" name="delete" value="delete"> Delete?
		</label></div>
        <div class="checkbox"><label>
			<input type="checkbox" name="reset" value="reset"> Reset?
		</label></div>

        <input type="submit" value="Update Team" class="btn btn-primary">
	</form>
</div>

@stop