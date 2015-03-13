@extends('layouts.default')

@section('content')
	<h3 id="page-title">Groups with {tag} [needs work]</h3>

	@foreach ($groupList as $group)
		<a href="/groups/{{ $group->id }}">{{ $group->name }}</a>
	@endforeach
@stop