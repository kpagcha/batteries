<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Batteries App</title>
	{{ HTML::style('css/bootstrap.css') }}
	{{ HTML::style('css/batteries-app.css') }}
	{{ HTML::script('js/jquery.js') }}
	<link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container-fluid">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
						<span class="sr-only">Enable navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="{{ URL::to('/') }}" class="navbar-brand">Batteries App</a>
				</div>
				<div class="collapse navbar-collapse" id="navbar-collapse">
					<ul class="nav navbar-nav">
						<li id="home"><a href="{{ URL::to('/') }}">Home</a></li>
						<li id="manage-batteries"><a href="#">Manage batteries</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</div>
	<div class="container">
		@yield("content")
		<div id="content" class="col-md-12"></div>
	</div>
	{{ HTML::script('js/bootstrap.js') }}
	{{ HTML::script('js/batteries.js') }}
</body>
</html>