@extends ('layouts.default')

@section ('content')
	
	<h3 id="page-title">Edit Information</h3>

	{!! Form::model($user, ['route' => ['users.update', $user->username], 'method' => 'PUT', 'class' => 'form']) !!}
		<div class="form-header-container">
			<span class="form-header">Edit</span>
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

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
			</div>

			{!! Form::submit('Edit', ['class' => 'form-button btn btn-block']) !!}
		</div>
	{!! Form::close() !!}

@stop