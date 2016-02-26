@extends('dashboard.restaurant')

@section('title', 'Add Tables')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Restaurnt: {{$restaurant->name}}</h3>
            <h4>Create new Table</h4>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class="col col-md-6">
                    @if(Session::has('success'))
                        <div class="alert alert-success" id="prompt">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    <form method="post" action="{{url('/tables/')}}" enctype="multipart/form-data">
                        <input type="hidden" id="rest_id" value="{{ $restaurant_id }}" name="restaurant_id">
                        @include('table.partials._add_form')
                        <button type = "submit" class="btn btn-primary" id="add_table">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection