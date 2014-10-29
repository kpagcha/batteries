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
	<div class="container">
		@yield("content")
	</div>
	{{ HTML::script('js/bootstrap.js') }}
</body>
</html>