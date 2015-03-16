@extends('layouts.default')

@section('content')

	@if(!$groupList->isEmpty())
		<h3 id="page-title">Groups tagged with <span class="label {{$tag}}">{{strtoupper($tag)}}</span></h3>

		@foreach ($groupList as $group)
			<a class="btn form-button btn-block {{$group->tag}}" href="/groups/{{ $group->id }}">{{ $group->name }}</a>
		@endforeach
	@else
		<h3 id="page-title">No Groups Found</h3>
	@endif
@stop