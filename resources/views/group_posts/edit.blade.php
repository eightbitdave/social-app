@extends('layouts.default')

@section('content')
	<h3 id="page-title">Edit your comment!</h3>

	{!! Form::model($post, ['route' => ['groups.posts.update', $post->id, $group_id], 'method' => 'PUT']) !!}
		<div class="form-header-container">
			<span class="form-header">Edit Post</span>
		</div>

		<div class="form-body">
		
			@include('errors.list')

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Post Title', 'minlength' => '3']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Post Body', 'minlength' => '3']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('code', null, ['class' => 'form-control', 'placeholder' => 'Write any code here', 'minlength' => '3']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::select('lang', $langs, null, ['class' => 'form-control', 'placeholder' => 'Code language', 'minlength' => '3']) !!}
			</div>

			{!! Form::submit('Edit Post', ['class' => 'form-button btn btn-block']) !!}
			<div class="clear"></div>
		</div>
	{!! Form::close() !!}

	<br>

	{!! Form::open(['method' => 'DELETE', 'route' => ['groups.posts.destroy', $post->id, $group_id]]) !!}
		<div class="form-group">
			{!! Form::submit('Delete Post', ['class' => 'btn btn-block btn-danger']) !!}
		</div>
	{!! Form::close() !!}

@stop