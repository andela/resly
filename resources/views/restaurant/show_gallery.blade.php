@extends('dashboard.restaurant_page')

@section('title-suffix', '- Gallery')

@section('details')
    @parent
    <div class='row'>
        <div class='col col-md-12 page-body'>
            @if(count($pictures) == 0)
                <p class='fa fa-frown-o' style="color:red;"> No pictures available</p>
            @else
                @foreach($pictures as $pic)
                    <div class = "col-md-3" style="text-align:center;">
                        <a class = "fancybox" href="http://res.cloudinary.com/ddnvpqjmh/image/upload/{{$pic->filename}}" data-fancybox-group="gallery" title="{{$pic->caption}}">
                            <img class = "gallery-thumbnail" src="http://res.cloudinary.com/ddnvpqjmh/image/upload/c_fill,h_300,w_300/{{$pic->filename}}"/>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('fancybox/source/jquery.fancybox.js') }}"></script>
    <script>
       $(document).ready(function() {
            $('.fancybox').fancybox();
        });
    </script>
@endsection

@section('styles')
    @parent
    <link rel='stylesheet' href="{{ asset('fancybox/source/jquery.fancybox.css') }}" />
@endsection