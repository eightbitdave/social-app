@extends('layouts.default')

@section('content')
	<h3 id="page-title">Create a post for {{$group->name}}</h3>

	{!! Form::open(['route' => ['groups.posts.store', $group->id], 'class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Create Post</span>
		</div>

		<div class="form-body">
		
			@include('errors.list')

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::text('title', "", ['class' => 'form-control', 'placeholder' => 'Post Title', 'minlength' => '3']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('content', "", ['class' => 'form-control', 'placeholder' => 'Post Body', 'minlength' => '3']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('code', "", ['class' => 'form-control', 'placeholder' => 'Write any code here (you can leave this blank)', 'minlength' => '3']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::select('lang', $langs, null, ['class' => 'form-control', 'placeholder' => 'Code language', 'minlength' => '3']) !!}
			</div>

			{!! Form::submit('Create Post', ['class' => 'form-button btn btn-block']) !!}
			<div class="clear"></div>
		</div>
	{!! Form::close() !!}
@stop