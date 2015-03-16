@extends('layouts.default')

@section('content')
	<h3 id="page-title">Do you want to leave {{ $group->name }}?</a>
	<br>

	{!! Form::open(['method' => 'DELETE', 'route' => ['groups.destroyMember', $group->id]]) !!}

		<div class="form-group">
			{!! Form::label("", null, []) !!}
			{!! Form::submit('Leave Group', ['class' => 'btn btn-block btn-danger']) !!}
		</div>
		<div class="clear"></div>
	{!! Form::close() !!}
@stop