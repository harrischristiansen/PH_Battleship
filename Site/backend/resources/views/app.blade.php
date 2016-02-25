<!DOCTYPE html>
<html>
    <head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    
        <title>PH Battleship</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:400,900" rel="stylesheet" type="text/css">
        
        <!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		
		<!-- Bootstrap Optional theme -->
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous"> -->
		
		<!-- Bootstrap IE8 Support -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    
	    <!-- Battleship Site CSS -->
	    <link rel="stylesheet" href="/css/battleship.css">

    </head>
    <body {!! session()->get('loggedIn') == "true" ? 'style="padding-top: 51px;"':'' !!}>
	    @if(session()->get('loggedIn') == "true")
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="/">PH Battleship</a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li><a href="/create-team">Add Team</a></li>
						<li><a href="/edit-team">Edit Teams</a></li>
						<li><a href="/rankings">Rankings</a></li>
						<li><a href="/manage">Manage Tournament</a></li>
						<li><a href="/game">Game Viewer</a></li>
						<li><a href="/logout">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
		@endif
		
		<div class="container-fluid mainContentContainer">
			@if(session()->get('loggedIn') == "true" && Request::path() != "game")
				<br>
			@endif
			@if(session()->has('msg'))
				<div class="container"><div class="alert alert-success" role="alert">{{session()->get('msg')}}</div></div>
			@endif
			@yield('content')
		</div>
		
                
		
		<!-- jQuery -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- Bootstrap JS -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		<!-- Page Specific JS -->
		@yield('customJS')
    </body>
</html>