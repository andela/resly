@extends('dashboard.index')

@section('title', 'Add Gallery')

@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>

<script>
(function() {
    
var bar = $('.bar');
var percent = $('.percent');
var status = $('#status');
   
$().ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    uploadProgress: function(event, position, total, percentComplete) {
        var percentVal = percentComplete + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    success: function() {
        var percentVal = '100%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
	complete: function(xhr) {
		status.html(xhr.responseText);
	}
}); 

})();       
</script>
<script type="text/javascript">
    $(function() {

        $('#uploadFile').click(function(e) {
            $('#fileUploadField').click();
            $('#filename').text('File added!');
            e.preventDefault();
        });

    });
</script>
@endsection

@section('details')
	@if (Session::has('flash_notification.message'))
    <div class="alert alert-{{ Session::get('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {{ Session::get('flash_notification.message') }}
    </div>
	@endif

	@if (count($errors) > 0)
		<div class="alert alert-danger">
        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>	
			@foreach ($errors->all() as $error) 
				<li>{{ $error }}</li>
			@endforeach
		</div>
	@endif

	<h3>Gallery</h3>
		<a href = # class = "fa fa-plus" id = "uploadFile"> Add Image</a> <br /> <span id="filename" style="color:green"></span>
		{!! Form::open(['url' => action('RestaurantGalleryController@store'), 'method' => 'post', 'files' => true]) !!} 
			<div class="form-group">
				{!! Form::file('image', ['style' => 'display:none;', 'id' => 'fileUploadField']) !!}
				{!! Form::text('caption', null, ['class' => 'form-control', 
				'placeholder' => 'Enter a caption for this image']) !!} <br>
				{!! Form::submit('Upload file', ['class' => 'btn btn-primary']) !!}
			</div>
		{!! Form::close()!!}
	<hr/>
	@include('partials.image')
@endsection