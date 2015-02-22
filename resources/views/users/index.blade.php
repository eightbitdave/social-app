@extends('layouts.default')

@section('content')
	<h3 id="page-title">Search for A User</h3>

	{!! Form::open(['class' => 'search-form']) !!}
		{!! Form::text('username', "", ['class' => 'form-control form-search']) !!}
		{!! Form::submit('Search', ['class' => 'form-button btn pull-right']) !!}
	{!! Form::close() !!}
@stop