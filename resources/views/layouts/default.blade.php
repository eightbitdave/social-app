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

		@if (Session::has('message'))
			<div class="message-alert alert alert-success alert-dismissable" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				{{ Session::get('message') }}
			</div>
		@endif

		<div id="container">
			@yield('content')
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	</body>
</html>