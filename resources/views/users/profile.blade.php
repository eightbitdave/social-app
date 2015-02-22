@extends('layouts.default')

@section('content')
	
	@if($user)
		<h3>{{ $user->name }}</h3>
		<h3 id="page-title">&#64;{{ $user->username }}</h3>
	@else
		<h3>No user with that ID.</h3>
	@endif

@stop