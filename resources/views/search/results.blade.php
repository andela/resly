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
                            @foreach ($results as $result)
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5>
                                                    <a href="/restaurants/page/{{$result->id}}">
                                                        {{ $result->getRestName()}}
                                                    </a>
                                                </h5>
                                                <p class="description">
                                                    "{{ strlen($result->description) > 40 ?
                                                    substr($result->description, 0, 40) . "..." :
                                                    $result->description
                                                    }}"
                                                </p>
                                                <p>
                                                    <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
                                                    {{ $result->location }} | {{ $result->address }}
                                                </p>
                                            </td>
                                            <td>
                                                <h2 style="color:#2196f3 " class='pull-right'>
                                                    {{ $result->tables->count() }}
                                                </h2>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
