@extends('layouts.master')

@section('title', 'Results')
@section('styles')
        <link rel="stylesheet" href="{{asset('css/dashboard.css')}}" media="screen" title="no title" charset="utf-8">
@endsection

@section('content')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Results {{Request::query('query')}} <a class = "btn btn-primary pull-right" href="/">Back</a></h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class='col col-md-12'>

                </div>
            </div>
        </div>
    </div>
@endsection
