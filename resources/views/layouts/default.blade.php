<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		{!! HTML::style('css/style.css') !!}
		{!! HTML::style('css/prism.css') !!}
	</head>

	<body>

		@include('partials.nav')

		@include('errors.messages')

		<div id="container">
			@yield('content')
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		{!! HTML::script('js/prism.js') !!}
	</body>
</html>