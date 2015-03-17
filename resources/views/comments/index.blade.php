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

				<pre><code class="language-{{$comment->lang}}">{{ $comment->code }}</code></pre>
				<a class="pull-right" href="#">&#64;dave</a>
				<div class="clear"></div>
			</div>
		@endforeach
	@endif
@stop