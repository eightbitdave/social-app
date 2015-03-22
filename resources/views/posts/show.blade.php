@extends('layouts.default')

@section('content')
	@if($post)
		<h3 id="page-title">{{ $post->title }}</h3>
		<p>{{ $post->content }}</p>

		@if (Auth::check())
			@if (Auth::user()->getId() == $post->user_id)
				<br><a class="btn btn-default" href="/posts/{{$post->id}}/edit">Edit</a>
			@endif
		@endif

		<a class="pull-right btn btn-default" href="/users/{{ $post->username }}">&#64;{{ $post->username }}</a>
		<div class="clear"></div>

		@if ($post->comments->count() == 1)
			<br><h4>{{$post->comments->count()}} comment</h4>
		@else
			<br><h4>{{$post->comments->count()}} comments</h4>
		@endif

		<a class="btn btn-default btn-block" href="/posts/{{$post->id}}/comments/create">Create Comment</a><br>

		@if($comments)
			@foreach($comments as $comment)
				<div class="comment-container">
					<p class="comment-para">{{ $comment->comment }}</p>

					@if($comment->code)
						<pre><code class="language-{{$comment->lang}}">{{ $comment->code }}</code></pre>
					@endif
					
					<a class="btn btn-default pull-right" href="/users/{{$comment->username}}">&#64;{{$comment->username}}</a>

					@if (Auth::check() && Auth::user()->getId() == $comment->user_id)
						<a class="btn btn-default" href="/posts/{{$post->id}}/comments/{{$comment->id}}/edit">Edit</a>
					@endif

					<div class="clear"></div>
				</div>
			@endforeach
		@endif

	@else
		<h3 id="page-title">No post found.</h3>
	@endif

@stop