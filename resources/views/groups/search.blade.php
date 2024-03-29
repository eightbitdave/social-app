@extends('layouts.default')

@section('content')
	<h3 id="page-title">Search Groups</h3>

	{!! Form::open(['route' => 'groups.search', 'class' => 'search-form']) !!}
		{!! Form::text('search-groups', "", ['class' => 'form-control form-search', 'autocomplete' => 'off', 'placeholder' => 'Search Groups']) !!}
		{!! Form::submit('Search', ['class' => 'form-button btn pull-right']) !!}
		<div class="clear"></div>
	{!! Form::close() !!}

	<br>
	<p>Can't find a cool group? Why not <a href="{{ route('groups.create') }}">create</a> one.</p>

 	@if (isset($results) && !empty($results))
 		<div id="search-results-container">
	 		<p id="search-header">Search results:</p>
			@foreach ($results as $result)
				 <?php 
			 		$string = $result->about;
			 		$string = strip_tags($string);

			 		if (strlen($string) > 100){
			 			$stringCut = substr($string, 0, 100);
			 		}
		 		?>
		 		<div class="search-result-item">
					<h4><a href="/groups/{{$result->id}}">{{$result->name}}</a></h4>
					<p class="search-result-content">{{ $string }}...</p>
					<a class="btn btn-info pull-right" href="/users/{{$result->creator}}">&#64;{{$result->creator}}</a>
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