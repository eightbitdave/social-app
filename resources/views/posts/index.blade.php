@extends('layouts.default')

@section('content')
	<h3 id="page-title">Posts</h3>


	<!-- NEEDS WORK -->
	
	{!! Form::open(['route' => 'post.search', 'class' => 'search-form']) !!}
		{!! Form::text('search-posts', "", ['class' => 'form-control form-search', 'autocomplete' => 'off', 'placeholder' => 'Search Posts']) !!}
		{!! Form::submit('Search', ['class' => 'form-button btn pull-right']) !!}
		<div class="clear"></div>
	{!! Form::close() !!}

	<p>Can't find what you're looking for? Try <a href="/post/create">creating</a> one.</p>
@stop