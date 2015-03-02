@extends('layouts.default')

@section('content')
	<h3 id="page-title">Search Groups</h3>

	{!! Form::open(['route' => 'group.search', 'class' => 'search-form']) !!}
		{!! Form::text('search-groups', "", ['class' => 'form-control form-search', 'autocomplete' => 'off', 'placeholder' => 'Search Groups']) !!}
		{!! Form::submit('Search', ['class' => 'form-button btn pull-right']) !!}
		<div class="clear"></div>
	{!! Form::close() !!}

	<br>
	<p>Can't find a cool group? Why not <a href="/post/create">create</a> one.</p>

 	@if (isset($results) && !empty($results))
 		<div id="search-results-container">
	 		<p id="search-header">Search results:</p>
			@foreach ($results as $result)
				 <?php 
			 		$string = $result->info;
			 		$string = strip_tags($string);

			 		if (strlen($string) > 100){
			 			$stringCut = substr($string, 0, 100);
			 		}
		 		?>
		 		<div class="search-result-item">
					<h4><a href="/group/{{$result->id}}">{{$result->name}}</a></h4>
					<p class="search-result-content">{{ $string }}...</p>
					<a class="pull-right" href="/user/{{$result->username}}">&#64;{{$result->username}}</a>
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