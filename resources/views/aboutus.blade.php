@extends('layouts.inner')

@section('title', 'About Us')
@section('styles')
    @parent
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato:400,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
    <link rel='stylesheet' type="text/css" href="{!! asset('css/bootstrap-social.css') !!}"/>
@endsection
@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>About Us</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
            <p>Resly is an online platform that connects restaurant owners and diners together.</p>
            <p>Resly aims to aid restaurant owners in attracting needed publicity to their restaurants and also provide an avenue for them to make money through booking of seats in their restaurants.</p>
            <p>The platform helps diners locate restaurants that meets their requirements closest to them. Diners can book for tables and make reservations in an easy and seamless manner.</p>

            </div>
        </div>
    </div>

@endsection
