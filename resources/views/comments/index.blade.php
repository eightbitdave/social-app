@extends('layouts.default')

@section('content')
	<h3 id="page-title">{{$post->title}} Comments</h3>
	<p>{{ $post->content }}</p>

	{{-- <pre><code class="language-{{$post->lang}}"></code></pre> TODO --}}

	@if ($post->comments->count() == 1)
		<br><h4>{{$post->comments->count()}} comment</h4>
	@else
		<br><h4>{{$post->comments->count()}} comments</h4>
	@endif

	<a class="btn btn-default btn-block" href="/posts/{{$post->id}}/comments/create">Create Comment</a><br>
	@if(!$comments->isEmpty())
		@foreach($comments as $comment)
			<div class="comment-container">
				<p class="comment-para">{{ $comment->comment }}</p>

				@if($comment->code)
					<pre><code class="language-{{$comment->lang}}">{{ $comment->code }}</code></pre>
				@endif
				
				<a class="btn btn-default pull-right" href="/users/{{$comment->post->username}}">&#64;{{$comment->post->username}}</a>

				@if (Auth::check() && Auth::user()->getId() == $comment->user_id)
					<a class="btn btn-default" href="/posts/{{$post->id}}/comments/{{$comment->id}}/edit">Edit</a>
				@endif

				<div class="clear"></div>
			</div>
		@endforeach
	@endif
@stop