@if (Session::has('message'))
	<div class="message-alert alert alert-success alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ Session::get('message') }}
	</div>
@endif

@if (Session::has('info_message'))
	<div class="message-alert alert alert-danger alert-dismissable" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		{{ Session::get('info_message') }}
	</div>
@endif