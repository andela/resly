@extends('dashboard.index')

@section('title', 'Add Tables')

@section('details')
    <div class="content">
        <div class="col-sm-6">
            @if(Session::has('success'))
                <div class="alert alert-success" id="prompt">
                    {{Session::get('success')}}
                </div>
            @endif

            <h4>Update Table</h4>
            {!! Form::model($table, ['url'=>url("/tables/$table->id"), 'method'=>'put']) !!}
                @include('table.partials._add_form')
                <button type = "submit" class="btn btn-primary" id="add_table">Save</button>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
