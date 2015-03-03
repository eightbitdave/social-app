@extends('layouts.default')

@section('content')
		{!! Form::open(['route' => 'auth.login', 'class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Log in</span>
		</div>

		<div class="form-body">
			<div class="form-group">
				@if($errors->has())
					<div class="alert alert-danger" role="alert">
				   		@foreach ($errors->all() as $error)
				        	<strong>Oops!</strong> {{ $error }}<br>
				    	@endforeach
				    </div>
				@endif
			</div>

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::email('email', "", ['class' => 'form-control', 'placeholder' => 'Email Address']) !!}
			</div>


			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
			</div>

			{!! Form::submit('Log in', ['class' => 'form-button btn']) !!}
			<a class="btn pull-right" href="/auth/password">Forgot your password?</a>
		</div>
	{!! Form::close() !!}
@stop