@extends('layouts.default')

@section('content')
	@if($post)
		<h3 id="page-title">{{ $post->title }}</h3>
		<p>{{ $post->content }}</p>

		@if (Auth::check())
			@if (Auth::user()->getId() == $post->user_id)
				<br><a class="btn btn-info" href="/posts/{{$post->id}}/edit">Edit</a>
			@endif
		@endif

		<a class="pull-right btn btn-info" href="/users/{{ $post->username }}">&#64;{{ $post->username }}</a>
		<div class="clear"></div>

	@else
		<h3 id="page-title">No post found.</h3>
	@endif

@stop