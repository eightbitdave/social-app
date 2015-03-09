@extends('layouts.default')

@section('content')
	<h3 id="page-title">Create a Post</h3>

		{!! Form::open(['route' => 'posts.store', 'class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Create Post</span>
		</div>

		<div class="form-body">
		
			@include('errors.list')

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::text('title', "", ['class' => 'form-control', 'placeholder' => 'Title', 'minlength' => '1']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('content', "", ['class' => 'form-control', 'placeholder' => 'Content', 'minlength' => '3']) !!}
			</div>

			{!! Form::submit('Create Post', ['class' => 'form-button btn btn-block']) !!}
			<div class="clear"></div>
		</div>
	{!! Form::close() !!}
@stop