@extends('layouts.default')

@section('content')
	<h3 id="page-title">Create a Group</h3>

	{!! Form::open(['route' => 'groups.store', 'class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Create Group</span>
		</div>

		<div class="form-body">
		
			@include('errors.list')

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::text('name', "", ['class' => 'form-control', 'placeholder' => 'Group Name', 'minlength' => '3']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('about', "", ['class' => 'form-control', 'placeholder' => 'About the group', 'minlength' => '3']) !!}
			</div>

			{!! Form::submit('Create Group', ['class' => 'form-button btn btn-block']) !!}
			<div class="clear"></div>
		</div>
	{!! Form::close() !!}
@stop