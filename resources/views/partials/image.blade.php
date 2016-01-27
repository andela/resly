<div class='row con'>
	@foreach($pictures as $pic)
		<div class = "col-md-3" style="text-align:center;">
			<a class = "fancybox" href="http://res.cloudinary.com/ddnvpqjmh/image/upload/{{ $pic->filename }}"
				data-fancybox-group="gallery" title="{{ $pic->caption }}">
				<img class = "gallery-thumbnail" src='http://res.cloudinary.com/ddnvpqjmh/image/upload/c_fill,h_300,w_300/{{ $pic->filename }}'
	     		 />
	     	</a>
     		 <a class ="fa fa-times delete-link" href="#" data-id = "{{ $pic->id }}"> Delete Image</a>
		</div>
	@endforeach
</div>