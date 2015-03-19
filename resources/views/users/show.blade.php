@extends('layouts.default')

@section('content')
	@if($user)
		<h3 id="page-title">{{ $user->name }}</h3>
		<h4 id="page-title">&#64;{{ $user->username }}</h4>
	@else
		<h3>No user with that username.</h3>
	@endif

	@if ($user->id == Auth::user()->getId())
		<a class="btn btn-default pull-right" href="/users/{{$user->username}}/edit">Edit details</a>
		<div class="clear"></div>
	@endif

	@if (!$groups->isEmpty())
		<h4>Groups I'm In:</h4>
		@foreach($groups as $group)
			<a class="btn form-button btn-block {{$group->tag}}" href="/groups/{{$group->id}}">{{ $group->name }}</a>
		@endforeach
		<br>
	@endif

	@if ($posts)
		<h4>My Recent Posts:</h4>
		@foreach ($posts as $post)
			<a class="btn btn-default btn-block" href="/posts/{{$post->id}}">{{ $post->title }}</a>
		@endforeach
		@if (count($posts) == 5)
			<br><a class="btn btn-default btn-block" href="/users/{{$user->username}}/posts">All Posts</a>
		@endif
	@else
		<h4>This user has no posts!</h4>
	@endif

@stop