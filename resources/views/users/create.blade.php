@extends('layouts.default')

@section('content')
	
	<h3 id="page-title">Create an Account</h3>

	{!! Form::open(['class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Sign Up</span>
		</div>
		<div class="form-body">
			<div class="form-group">
				{!! Form::label('Username', "", ['class' => 'form-label']) !!}
				{!! Form::text('username', "", ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('Password', "", ['class' => 'form-label']) !!}
				{!! Form::password('password', ['class' => 'form-control']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('Email', "", ['class' => 'form-label']) !!}
				{!! Form::email('email', "", ['class' => 'form-control']) !!}
			</div>

			{!! Form::submit('Sign Up', ['class' => 'form-button btn']) !!}
			<a class="forgot" href="{{ URL::to('password/email')}}">Forgot your password?</a>
		</div>
	{!! Form::close() !!}
@stop