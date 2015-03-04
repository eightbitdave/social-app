@extends('layouts.default')

@section('content')
	@if($post)
		<h3 id="page-title">{{ $post->title }}</h3>
		<p>{{ $post->content }}</p>

		<a class="pull-right" href="/user/{{ $post->username }}">&#64;{{ $post->username }}</a>
		<div class="clear"></div><br>

		@if (Auth::check())
			@if (Auth::user()->getId() == $post->user_id)
				<a class="btn btn-info" href="/post/{{$post->id}}/edit">Edit</a>
			@endif
		@endif
	@else
		<h3 id="page-title">No post found.</h3>
	@endif

@stop