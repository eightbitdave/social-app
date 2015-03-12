@extends('layouts.default')

@section('content')
	
	@if($group)
		<h3 id="page-title">{{ $group->name }} <span class="label {{ $tag }}">{{ strtoupper($tag) }}</span></h3>
		
		<!-- Static for now -->
		<h4 id="group-members-number">Member Count: 7</h4>

		<p class="group-creator">Creator: <a href="/users/{{$group->creator}}">&#64;{{ $group->creator }}</a></p>

		<p class="group-about">About: {{ $group->about }}</p>

		
		@if (Auth::check() && Auth::user()->getUsername() == $group->creator)
			<a class="btn form-button btn-large pull-right {{ $tag }}" href="/groups/{{$group->id}}/edit">Edit Group</a>
		@else
			<a class="btn form-button btn-large pull-right {{ $tag }}" href="/groups/{{$group->id}}/join">Join Group</a>
		@endif
		


		<div class="clear"></div>

	@else
		<h3>No group was found.</h3>
	@endif

@stop