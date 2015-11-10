@if (Session::has('info'))
	<div class="alert alert-success" role="alert">
		{{ Session::get('info')}}
	</div>
@endif