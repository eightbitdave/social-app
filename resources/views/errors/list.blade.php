<div class="form-group">
	@if($errors->any())
		<div class="alert alert-danger" role="alert">
	   		@foreach ($errors->all() as $error)
	        	<strong>Oops!</strong> {{ $error }}<br>
	    	@endforeach
	    </div>
	@endif
</div>