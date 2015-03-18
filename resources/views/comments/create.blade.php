@extends('layouts.default')

@section('content')
	<h3 id="page-title">Post a comment!</h3>

	{!! Form::open(['route' => ['posts.comments.store', $post_id], 'class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Post Comment</span>
		</div>

		<div class="form-body">
		
			@include('errors.list')

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('comment', "", ['class' => 'form-control', 'placeholder' => 'Comment Body', 'minlength' => '3']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('code', "", ['class' => 'form-control', 'placeholder' => 'Write any code here', 'minlength' => '3']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::select('lang', $langs, null, ['class' => 'form-control', 'placeholder' => 'Code language', 'minlength' => '3']) !!}
			</div>

			{!! Form::submit('Post Comment', ['class' => 'form-button btn btn-block']) !!}
			<div class="clear"></div>
		</div>
	{!! Form::close() !!}

@stop