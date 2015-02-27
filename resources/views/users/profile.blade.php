@extends('layouts.default')

@section('content')
	@if($user)
		<h3 id="page-title">{{ $user->name }}</h3>
		<h4 id="page-title">&#64;{{ $user->username }}</h4>
	@else
		<h3>No user with that username.</h3>
	@endif
@stop