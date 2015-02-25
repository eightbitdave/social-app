@extends('layouts.default')

@section('content')
	<h3 id="page-title">{{ $post->title }}</h1>
	<p>{{ $post->content }}</p>

	<small>Posted by <a href="/user/{{ $post->username }}">&#64;{{ $post->username }}</a>.</small>
@stop