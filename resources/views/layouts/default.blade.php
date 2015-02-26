<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		{!! HTML::style('css/style.css') !!}
	</head>

	<body>
		<nav>
			<span id="nav-header">EduCode</span>
		</nav>
		<br>
		<!-- Example Pill Navigation

		<ul class="nav nav-pills" style="margin-left:15px;">
			<li role="presentation" class="active"><a href="#">Home</a></li>
			<li role="presentation"><a href="#">Profile</a></li>
  			<li role="presentation"><a href="#">Messages</a></li>
		</ul>
		
		-->

		<div id="container">
			@yield('content')
		</div>
	</body>
</html>