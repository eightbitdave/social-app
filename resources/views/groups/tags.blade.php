@extends('layouts.default')

@section('content')
	<h3 id="page-title">Search Groups by Tag</h3>

	@foreach ($tags as $tag)
		<a class="btn form-button btn-block {{ $tag }}" href="/groups/tag/{{ $tag }}">{{ strtoupper($tag) }}</a>
	@endforeach
@stop