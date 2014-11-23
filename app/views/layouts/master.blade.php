<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Batteries App</title>
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/batteries-app.css') }}
	{{ HTML::script('js/jquery.js') }}
	{{ HTML::script('js/jquery-ui.js') }}
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="sr-only">Enable navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" id="home-brand" class="navbar-brand">Batteries App</a>
			</div>
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li id="home"><a href="#">Home</a></li>
					@if (Auth::check() && Auth::user()->hasRole('administrator'))
						<li id="manage-batteries"><a href="/battery/all">Manage batteries</a></li>
						<li id="manage-users"><a href="/users/all">Manage users</a></li>
					@endif
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::check())
						<li id="logout"><a href="/logout">Logout ({{ Auth::user()->email }})</a></li>
					@else
						<li id="login"><a href="/login">Login</a></li>
						<li id="register"><a href="/register">Sign up</a></li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	<div class="container">
		<div id="notice" class="col-md-3 col-md-offset-3 col-sm-5 col-sm-offset-2 col-xs-8 col-xs-offset-2 text-center alert alert-success hidden"></div>
		<div id="content" class="col-md-12">
			@yield("content")
		</div>
	</div>
	{{ HTML::script('js/bootstrap.js') }}
	{{ HTML::script('js/batteries.js') }}
	{{ HTML::script('js/home.js') }}
	{{ HTML::script('js/users.js') }}
	{{ HTML::script('js/cart.js') }}
</body>
</html>