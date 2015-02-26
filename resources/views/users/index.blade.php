@extends('layouts.default')

@section('content')
	<h3 id="page-title">Search for a User</h3>

	<!-- Search route needs defined -->

	{!! Form::open(['class' => 'search-form']) !!}
		{!! Form::text('username', "", ['class' => 'form-control form-search', 'autocomplete' => 'off']) !!}
		{!! Form::submit('Search', ['class' => 'form-button btn pull-right']) !!}
		<div class="clear"></div>
	{!! Form::close() !!}
@stop