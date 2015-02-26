@extends('layouts.default')

@section('content')
	<h3 id="page-title">Create an Account</h3>

	{!! Form::open(['route' => 'user.store', 'class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Sign Up</span>
		</div>
		<div class="form-body">
			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::text('name', "", ['class' => 'form-control', 'placeholder' => 'Name']) !!}
			</div>

			<div class="input-group username-group">
				<span class="input-group-addon" id="basic-addon1">@</span>
				{!! Form::label('', "", []) !!}
				{!! Form::text('username', "", ['class' => 'form-control', 'placeholder' => 'Username']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::password('retype-password', ['class' => 'form-control', 'placeholder' => 'Retype Password']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::email('email', "", ['class' => 'form-control', 'placeholder' => 'Email']) !!}
			</div>

			{!! Form::submit('Sign Up', ['class' => 'form-button btn']) !!}
			<a class="forgot" href="{{ URL::to('password/email')}}">Forgot your password?</a>
		</div>
	{!! Form::close() !!}
@stop