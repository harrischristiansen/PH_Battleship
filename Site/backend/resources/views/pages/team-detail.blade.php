@extends("app")

@section("content")
<h1>Team Detail - {{$team['name']}}</h1>
{{$team}}


<form method="post" action="/edit-team/{{$team['id']}}">
        {!! csrf_field() !!}
        <input type="textfield" name="teamName" id="teamName" value = "{{$team['name']}}" placeholder="teamName">
        <br>
        <input type="textfield" name="teamAbb" id="teamAbb" value = "{{$team['abb']}}" placeholder="teamAbb">
        <br>
        <input type="checkbox" name="delete" value="delete">Delete?<br>
        <input type="checkbox" name="reset" value="reset">Reset?<br>

        <input type="submit" value="Create Team">
</form>


@stop