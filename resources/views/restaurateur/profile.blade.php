@extends('layouts.master')

@section('title', 'Your Profile')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/auth.css') !!}">
<link rel="stylesheet" type="text/css" href="{!! asset('css/diner-profile.css') !!}">
@endsection

@section('content')
    <div class="container  white">
        @if ($restaurant)
        <div class="row">
            <div class="col-xs-8">
                <h3>{{$restaurant->name}} restaurant</h3>
                <table class="table table-striped">
                    <tr>
                        <td>Location:</td>
                        <td>{{$restaurant->location}}</td>
                    </tr>
                    <tr>
                        <td>Telephone:</td>
                        <td>{{$restaurant->telephone}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$restaurant->email}}</td>
                    </tr>
                    <tr>
                        <td>Opening Time:</td>
                        <td>{{$restaurant->opening_time}}</td>
                    </tr>
                    <tr>
                        <td>Closing Time:</td>
                        <td>{{$restaurant->closing_time}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-xs-4">
                <h3>Tables</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>table no</th>
                            <th>seats number</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurant->tables as $table)
                            <tr>
                                <td>
                                    #{{$table->table_id}}
                                </td>
                                <td>
                                    {{$table->seats_number}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="/wines" class="btn btn-primary">View Wine</a>
        </div>
        @else
            <a href="/restaurants/add" class="btn btn-primary">add restaurant</a>
            <a href="/wines" class="btn btn-primary">Add Wine selection</a>
        @endif
    </div>
@endsection