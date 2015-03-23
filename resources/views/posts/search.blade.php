@extends('layouts.default')

@section('content')
	<h3 id="page-title">Search Posts</h3>


	<!-- NEEDS WORK -->
	
	{!! Form::open(['route' => 'posts.search', 'class' => 'search-form']) !!}
		{!! Form::text('search-posts', "", ['class' => 'form-control form-search', 'autocomplete' => 'off', 'placeholder' => 'Search Posts']) !!}
		{!! Form::submit('Search', ['class' => 'form-button btn pull-right']) !!}
		<div class="clear"></div>
	{!! Form::close() !!}

	<br>
	<p>Can't find what you're looking for? Why not <a href="/posts/create">create</a> a post.</p>

 	@if (isset($results) && !empty($results))
 		<div id="search-results-container">
	 		<p id="search-header">Search results:</p>
			@foreach ($results as $result)
				 <?php 
			 		$string = $result->content;
			 		$string = strip_tags($string);

			 		if (strlen($string) > 100){
			 			$stringCut = substr($string, 0, 100);
			 		}
		 		?>
		 		<div class="search-result-item">
					<h4><a href="/posts/{{$result->id}}">{{$result->title}}</a></h4>
					<p class="search-result-content">{{ $string }}...</p>
					<a class="pull-right" href="/users/{{$result->username}}">&#64;{{$result->username}}</a>
					<div class="clear"></div>
				</div>
			@endforeach
		</div>
	@elseif (isset($results) && empty($results))
		<div class="alert alert-danger" role="alert">
			<strong>Oops!</strong> That search term didn't return anything.
   		</div>
	@endif


@stop