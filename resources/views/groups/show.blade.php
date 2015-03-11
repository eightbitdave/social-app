@extends('layouts.default')

@section('content')
	
	@if($group)
		<h3 id="page-title">{{ $group->name }}</h3>
		
		<!-- Static for now -->
		<h4 id="group-members-number">Member Count: 7</h4>

		<p class="group-creator">Creator: <a href="/users/{{$group->creator}}">&#64;{{ $group->creator }}</a></p>

		<p class="group-about">{{ $group->about }}</p>

		<a class="btn form-button btn-lrg pull-right" href="/groups/{{$group->id}}/join">Join Now</a>
		<div class="clear"></div>


		<div class="clear"></div>
	@else
		<h3>No group was found.</h3>
	@endif

@stop