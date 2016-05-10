@extends('layouts.inner')

@section('title', 'Contact Us')
@section('styles')
    @parent
    <link href='https://fonts.googleapis.com/css?family=Pacifico|Lato:400,100' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,400,700">
    <link rel='stylesheet' type="text/css" href="{!! asset('css/bootstrap-social.css') !!}"/>
@endsection
@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Contact Us</h3>
        </div>
    </div>
    <div class='row' id="contactus">
        <div class='col col-md-12 page-body'>
            <div class="row">
	          
				<table class="table table-striped">
                    <tr>
                        <td width="17%"><i class="fa fa-map-marker"></i> Location</td>
                        <td>55, Andela Street, Kenya, Nigeria</td>
                    </tr>
                    <tr>
                        <td width="17%"><i class="fa fa-phone"></i> Telephone</td>
                        <td>+234 (0) 803 837 8157, +234 (0) 803 671 6444</td>
                    </tr>
                    <tr>
                        <td width="17%"><i class="fa fa-envelope"></i> Email</td>
                        <td colspan="4">contactus@resly.app</td>
                    </tr>
                    
                </table>
            </div>
        </div>
    </div>

@endsection

