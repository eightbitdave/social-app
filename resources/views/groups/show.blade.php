@extends('layouts.default')

@section('content')
	
	@if($group)
		<h3 id="page-title">{{ $group->name }} <a class="label-link" href="/groups/tag/{{$group->tag}}"><span class="label {{ $tag }}">{{ strtoupper($tag) }}</span></a></h3>
		
		<h4 id="group-members-number">Member Count: {{$group->users->count()}}</h4>

		<p class="group-creator">Creator: <a href="/users/{{$group->creator}}">&#64;{{ $group->creator }}</a></p>

		<p class="group-about">About: {{ $group->about }}</p>

		
		@if (Auth::check() && Auth::user()->getUsername() == $group->creator)

			<a class="btn form-button btn-large pull-right {{ $tag }}" href="/groups/{{$group->id}}/edit">Edit Group</a>

		@elseif ($isJoined)
			<a class="btn form-button btn-large pull-right {{ $tag }}" href="/groups/{{$group->id}}/leave">Leave Group</a>
		@else
			<a class="btn form-button btn-large pull-right {{ $tag }}" href="/groups/{{$group->id}}/join">Join Group</a>

		@endif
		
		
		<div class="clear"></div>


		@if(!$members->isEmpty())
			<br><h4>Group Members</h4>

			@foreach($members as $member)
				<a class="btn form-button btn-block {{$tag}}" href="/users/{{$member->username}}"> &#64;{{ strtolower($member->username) }}</a>
			@endforeach
		@elseif (Auth::check() && Auth::user()->getUsername() == $group->creator)
			{{-- Show nothing --}}
		@else
			<h4>This group has no members, why not be the first?</h4>
		@endif

	@else
		<h3>No group was found.</h3>
	@endif

@stop