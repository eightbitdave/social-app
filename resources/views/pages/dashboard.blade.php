@extends('layouts.default')

@section('content')
	<h3 id="page-title">Dashboard</h3>

	<div class="btn-group btn-group-justified" role="group" aria-label="...">
	  <div class="btn-group" role="group">
	    <a class="btn btn-default" href="/posts">Posts</a>
	  </div>
	  <div class="btn-group" role="group">
	    <a class="btn btn-default" href="/groups">Groups</a>
	  </div>
	  <div class="btn-group" role="group">
	    <a class="btn btn-default" href="/auth/logout">Logout</a>
	  </div>
	</div>
@stop