@extends('layouts.default')

@section('content')
	
	<h3 id="page-title">{{$group->name}} Members <span class="label {{$group->tag}}">{{ strtoupper($group->tag) }}</span></h3>

	@foreach($members as $member)

		<a class="btn form-button btn-block {{$group->tag}}" href="/users/{{$member->username}}">&#64;{{ $member->username }}</a>

	@endforeach

@stop