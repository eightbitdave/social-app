@extends('layouts.default')

@section('content')
	<h3 id="page-title">{{ $post->title }}</h3>
	<p>{{ $post->content }}</p>

	<a class="btn btn-info" href="/post/{{$post->id}}/edit">Edit this post</a>
	<a class="pull-right" href="/post/{{ $post->username }}">&#64;{{ $post->username }}</a>
	<div class="clear"></div>

@stop