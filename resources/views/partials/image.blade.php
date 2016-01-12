<div class='row'>
	@foreach($pictures as $pic)
		<div class = "col-md-3 img-thumbnail">
			<img src='http://res.cloudinary.com/ddnvpqjmh/image/upload/c_fill,h_200,w_200/{{ $pic->filename }}'
	     		width='200' height='200' />
		</div>
	@endforeach
</div>