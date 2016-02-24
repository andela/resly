@extends('dashboard.restaurant')

@section('title', 'Add Gallery')

@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>

<script type="text/javascript" src="{{ asset('fancybox/source/jquery.fancybox.js') }}"></script>

<script>

//jquery forms 
(function() {
    
var bar = $('.progress-bar');
var percent = $('.percent');
var status = $('#status');
var errStatus = $('#errStatus');
var prog_bar = $('.progress');
   
$('form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
        prog_bar.show();
    },
    uploadProgress: function(event, position, total, percentComplete) {
        if(parseInt(percentComplete) > 98){
            percentComplete = parseInt(percentComplete) - 5;
        } else {
            percentComplete = parseInt(percentComplete);
        }
        var percentVal = percentComplete.toString() + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    error: function(data){
        $('#uploadFailure').show();
        var errors = JSON.parse(data.responseText).image[0];
        errStatus.html(errors);
        console.log(errors);
        // Render the errors with js ...

        bar.width('20%');
        bar.addClass('progress-bar-danger');
        percent.html('failed');
    },
    success: function(result) {
        //insert new object
        parent = $(".con").children().first();
        parent.addClass('random');
    },
    complete: function(xhr){
        console.log(xhr);
        console.log(JSON.parse(xhr.responseText));
        result = JSON.parse(xhr.responseText);
        if (result.status == 'successful'){
            var percentVal = '100%';
            bar.width(percentVal);
            percent.html(percentVal);
            prog_bar.hide();
            $('#uploadSuccess').show();
            status.html("Upload Complete!!");
            new_element = '<div class = "col-md-3" style="text-align:center;">';
            new_element += '<a class = "fancybox" href="http://res.cloudinary.com/ddnvpqjmh/image/upload/' +result.filename+'"';
            new_element += 'data-fancybox-group="gallery" title="'+result.caption+'">';
            new_element += '<img class = "gallery-thumbnail" src="http://res.cloudinary.com/ddnvpqjmh/image/upload/c_fill,h_300,w_300/'+result.filename+'"/></a>';
            new_element += '<a class ="fa fa-times delete-link" href="#" data-id ="'+result.pic_id+'"> Delete Image</a></div>';
            new_element += '</div>';
            if( $('.con').html().trim() == '') {
                $('.con').html(new_element);
            } else {
                $(new_element).insertBefore('.random');
            }
        } else {
            console.log('completed but failed');
        }
        
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
    $(document).ready(function() {
        $('.fancybox').fancybox();
        $(document.body).on('click', '.delete-link', function(e){
            var element = $(this);
            $.ajax({
                url: "{!! url('gallery') !!}/"+element.attr('data-id'),
                type: "DELETE", 
                beforeSend: function(){
                    if (confirm("Are you sure you want to delete this picture?") == false) {
                        return false;
                    }
                    element.parent().css('opacity', 0.6);
                    element.removeClass('fa');
                    element.removeClass('fa-times');
                    element.html('deleting picture...');
                },
                success: function(result){
                    element.parent().remove();
                }
            }
            );
            e.preventDefault();
        });
    });
</script>
<style>
.gallery-thumbnail:hover{
    opacity:0.7;
    cursor:pointer;
}
.gallery-thumbnail{
    margin-top:1em;
    border:solid thick #000;
    width:100%;
    max-width: 400px;
    height:auto;
}
</style>
@endsection

@section('details')
    @parent
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

    <div class="row">
        <div class="col-md-7">
    	    <p>
                <a href='/restaurants'>Restaurants</a> >> 
                <a href='/restaurants/{{$restaurant->id}}'>{{$restaurant->name}}</a> >> 
                Gallery
            </p>
    		<a href = # class = "fa fa-plus" id = "uploadFile"> Add a picture of your restaurant</a> <br /> <span id="filename" style="color:green"></span>
    		{!! Form::open(['url' => url('/gallery/'), 'method' => 'post', 'files' => true]) !!} 
    			<div class="form-group">
    				{!! Form::file('image', ['style' => 'display:none;', 'id' => 'fileUploadField']) !!}
    				{!! Form::text('caption', null, ['class' => 'form-control', 
    				'placeholder' => 'Enter a caption for this picture']) !!} <br>
                    <input type='hidden' name='rest_id' value='{{$rest_id}}'>
    				{!! Form::submit('Upload file', ['class' => 'btn btn-primary']) !!}
    			</div>
    		{!! Form::close()!!}
            <div class="progress" style="height:18px; border-radius:10px; display:none;">
                <div class="progress-bar progress-bar-striped active percent" role="progressbar"
                    aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:1%;">
                     0%
                 </div>
            </div>
        
            <div class="alert alert-success" id ="uploadSuccess" style="display:none">
                <span id="status">Uploaded Successfully</span>
            </div>

            <div class="alert alert-danger" id ="uploadFailure" style="display:none">
                <span id="errStatus"></span>
            </div>
        </div>
    </div>
	<hr/>
	@include('partials.image')
@endsection