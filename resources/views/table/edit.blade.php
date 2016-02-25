@extends('dashboard.index')

@section('title', 'Add Tables')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Restaurnt: {{$table->restaurant->name}}</h3>
            <h4>Edit Table: <small>{{$table->label}} table (has {{$table->seats_number}} Chairs)</small></h4>
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
                    {!! Form::model($table, ['url'=>url("/tables/$table->id"), 'method'=>'put']) !!}
                        @include('table.partials._add_form')
                        <button type = "submit" class="btn btn-primary" id="add_table">Save</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </di
        v>
    </div>
@endsection
