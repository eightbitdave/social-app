@extends ('layouts.default')

@section('content')
	<h3 id="page-title">Update your Post</h3>

	{!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'PUT']) !!}
		<div class="form-header-container">
			<span class="form-header">Update Post</span>
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
				{!! Form::text('title', null, ['class' => 'form-control', 'minlength' => '1']) !!}
			</div>

			<div class="form-group form-last">
				{!! Form::label('', "", []) !!}
				{!! Form::textarea('content', null, ['class' => 'form-control', 'minlength' => '3']) !!}
			</div>

			{!! Form::submit('Update Post', ['class' => 'form-button btn btn-block']) !!}
			<div class="clear"></div>
		</div>
	{!! Form::close() !!}
	<br>
	{!! Form::open(['method' => 'DELETE', 'route' => ['post.destroy', $post->id]]) !!}
		<div class="form-group">
			{!! Form::submit('Delete', ['class' => 'btn btn-block btn-danger']) !!}
		</div>
		<div class="clear"></div>
	{!! Form::close() !!}
@stop()