@extends('layouts.default')

@section('content')
		<h3 id="page-title">Login</h3>

		{{Session::get('error_messages')}}


		@if ($errors->any())
		 	{{ var_dump($errors) }}
		@else
		 	No errors
		@endif

		{!! Form::open(['route' => 'login', 'class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Login</span>
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

			{{ Session::get('message')}}

			<div class="form-group">
				{!! Form::label('', "", []) !!}
				{!! Form::email('email', "", ['class' => 'form-control', 'placeholder' => 'Email']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
			</div>

			{!! Form::submit('Create Post', ['class' => 'form-button btn pull-right']) !!}
			<div class="clear"></div>
		</div>
	{!! Form::close() !!}
@stop