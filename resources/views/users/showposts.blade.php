@extends('layouts.default')

@section('content')
	
	<h3 id="page-title">Posts by &#64;{{ $user->username }}</h3>

	@if (count($posts))
		@foreach ($posts as $post)
			<a class="btn btn-block btn-default" href="/posts/{{$post->id}}">{{$post->title}}</a>
		@endforeach
	@else
		<p>This user has no posts, bummer!</p>
	@endif
@stop