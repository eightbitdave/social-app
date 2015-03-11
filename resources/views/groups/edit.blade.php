@extends('layouts.default')

@section('content')
	<h3 id="page-title">Update your Group</h3>

	{!! Form::model($group, ['route' => ['groups.update', $group->id], 'method' => 'PUT']) !!}

		<div class="form-header-container">
			<span class="form-header">Update Group Info</span>
		</div>

		<div class="form-body">
			
			@include('errors.list')

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::text('name', null, ['class' => 'form-control', 'minlength' => '3']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('about', null, ['class' => 'form-control', 'minlength' => '3']) !!}
			</div>

			{!! Form::submit('Update Group', ['class' => 'form-button btn btn-block']) !!}
			<div class="clear"></div>
		</div>

	{!! Form::close() !!}
@stop