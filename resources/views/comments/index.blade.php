@extends('layouts.default')

@section('content')
	<h3 id="page-title">{{$post->title}} Comments</h3>
	<p>{{ $post->content }}</p>

	{{-- <pre><code class="language-{{$post->lang}}"></code></pre> TODO --}}

	@if(!$comments->isEmpty())
		<br><h4>Comments:</h4>
		@foreach($comments as $comment)
			<div class="comment-container">
				<p class="comment-para">{{ $comment->comment }}</p>

				@if($comment->code)
					<pre><code class="language-{{$comment->lang}}">{{ $comment->code }}</code></pre>
				@endif
				
				<a class="btn btn-default pull-right" href="/users/{{$comment->post->username}}">&#64;dave</a>

				@if ($comment->user_id == Auth::user()->getId())
					<a class="btn btn-default" href="/posts/{{$post->id}}/comments/{{$comment->id}}/edit">Edit</a>
				@endif

				<div class="clear"></div>
			</div>
		@endforeach
	@endif
@stop