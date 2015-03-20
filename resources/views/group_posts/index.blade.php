@extends('layouts.default')

@section('content')
	<h3 id="page-title">{{$group->name}} Posts</h3>

	@if ($group->posts->count() == 1)
		<br><h4>{{$group->posts->count()}} post</h4>
	@else
		<br><h4>{{$group->posts->count()}} posts</h4>
	@endif

	<a class="btn btn-default btn-block" href="/groups/{{$group->id}}/posts/create">Create Post</a><br>
	@if(!$posts->isEmpty())
		@foreach($posts as $post)
			<div class="comment-container">

				<br><h3 class="post-head">{{$post->title}}</h3>

				<p class="post-para">{{ $post->content }}</p>

				@if($post->code)
					<pre><code class="language-{{$post->lang}}">{{ $post->code }}</code></pre>
				@endif
				
				<a class="btn btn-default pull-right" href="/users/{{$post->user->username}}">&#64;{{$post->user->username}}</a>

				@if (Auth::check() && Auth::user()->getId() == $post->user_id)
					<a class="btn btn-default" href="/groups/{{$group->id}}/posts/{{$post->id}}/edit">Edit</a>
				@endif

				<div class="clear"></div>
			</div>
		@endforeach
	@endif
@stop