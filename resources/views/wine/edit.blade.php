@extends('layouts.master')

@section('title', 'Create wine')

@if (Auth::restaurateur()->check()) 
  @section('navbar')
    @include('partials.navbar')
  @endsection
@endif

@section('content')

<div class="container" style="padding-top:70px;">
  <h1>Update wine</h1>
    {!! Form::model($wine,['method' => 'PATCH','route'=>['wines.update',$wine->id]]) !!}
    <div class="form-group">
        {!! Form::label('Name', 'Name:') !!}
        {!! Form::text('name',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Year', 'Year:') !!}
        {!! Form::text('year',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Description', 'Description:') !!}
        {!! Form::textarea('description',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('Price', 'Price:') !!}
        {!! Form::text('price',null,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
    </div>
    {!! Form::close() !!}
</div>
@endsection