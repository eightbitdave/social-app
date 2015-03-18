@extends('layouts.default')

@section('content')
	<h3 id="page-title">Edit your comment!</h3>

	{!! Form::model($comment, ['route' => ['posts.comments.update', $comment->id, $postId], 'method' => 'PUT']) !!}
		<div class="form-header-container">
			<span class="form-header">Edit Comment</span>
		</div>

		<div class="form-body">
		
			@include('errors.list')

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('comment', null, ['class' => 'form-control', 'minlength' => '3']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('code', null, ['class' => 'form-control', 'minlength' => '3']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::select('lang', $langs, null, ['class' => 'form-control', 'minlength' => '3']) !!}
			</div>

			{!! Form::submit('Edit Comment', ['class' => 'form-button btn btn-block']) !!}
			<div class="clear"></div>
		</div>
	{!! Form::close() !!}

@stop