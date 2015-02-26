<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		{!! HTML::style('css/style.css') !!}
	</head>

	<body>
		<nav class="navbar navbar-default">
		    <div class="container-fluid">
		    	<a class="navbar-brand" href="#">EduCode</a>
		    </div>
		</nav>

		<div id="container">
			@yield('content')
		</div>
	</body>
</html>