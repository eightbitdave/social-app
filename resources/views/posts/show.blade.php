@extends('layouts.default')

@section('content')
	<h3 id="page-title">{{ $post->title }}</h3>
	<p>{{ $post->content }}</p>

	<a class="pull-right" href="/user/{{ $post->username }}">&#64;{{ $post->username }}</a>
	<div class="clear"></div>
@stop