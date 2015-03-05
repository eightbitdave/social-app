@extends('layouts.default')

@section('content')
	
	<h3 id="page-title">Posts by &#64;{{ $user->username }}</h3>


	@if ($posts)
		@foreach ($posts as $post)
			<a href="/posts/{{$post->id}}">{{$post->title}}</a><br>
		@endforeach
	@else
		<p>This user has no posts, bummer!</p>
	@endif
@stop