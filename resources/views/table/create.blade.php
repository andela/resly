@extends('dashboard.restaurant')

@section('title', 'Add Tables')

@section('details')
    @parent
    <div class="content">
        <div class="col-sm-6">
            @if(Session::has('success'))
                <div class="alert alert-success" id="prompt">
                    {{Session::get('success')}}
                </div>
            @endif

            <h4>Create new Table</h4>
            <form method="post" action="{{url('/tables/')}}" enctype="multipart/form-data">
                <input type="hidden" id="rest_id" value="{{ $restaurant_id }}" name="restaurant_id">
                @include('table.partials._add_form')
                <button type = "submit" class="btn btn-primary" id="add_table">Add</button>
            </form>
        </div>
    </div>
@endsection
