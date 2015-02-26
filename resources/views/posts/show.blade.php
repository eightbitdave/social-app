@extends('layouts.default')

@section('content')
	<h3 id="page-title">{{ $post->title }}</h3>
	<p>{{ $post->content }}</p>

	<small class="pull-right"><a href="/user/{{ $post->username }}">&#64;{{ $post->username }}</a></small>
	<div class="clear"></div>
@stop