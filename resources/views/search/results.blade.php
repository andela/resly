@extends('dashboard.search')

@section('title', 'Results')


@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Results  <a class = "btn btn-primary pull-right" href="/">Back</a></h3>

        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class="col col-md-12">
                    @if (! $results->count())
                        <p>No results found, sorry</p>
                    @else
                        <table class="table">
                            <tbody>
                                @foreach ($results as $result)
                                    <tr>
                                        <td class='table-image-holder'>
                                            @if($result->pictures->first() !== null)
                                                <img src="http://res.cloudinary.com/ddnvpqjmh/image/upload/c_fill,h_300,w_300/{{$result->pictures->first()->filename}}" class='table-image'>
                                            @else
                                                <img src="{{asset('img/no-image-placeholder.jpg')}}" class='table-image'>

                                            @endif

                                        </td>
                                        <td>
                                            <h3>
                                                <a href="/restaurants/page/{{$result->id}}">
                                                    {{ $result->getRestName()}}
                                                </a>

                                                <span style="color:#2196f3 " class='pull-right'>
                                                    {{ $result->tables->count() }} tables
                                                </span>
                                            </h3>

                                            <hr>
                                            <div>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </div>

                                            <p class="description">
                                                "{{ strlen($result->description) > 40 ?
                                                substr($result->description, 0, 40) . "..." :
                                                $result->description
                                                }}"
                                            </p>
                                            <p>
                                                <span class="fa fa-map-marker" aria-hidden="true"></span>
                                                {{ $result->location }} | {{ $result->address }}
                                            </p>
                                            <p>
                                                <i class='fa fa-clock-o'></i>
                                                {{$result->opening_time}} -
                                                {{$result->closing_time}}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
