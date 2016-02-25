@extends('dashboard.index')

@section('title', 'Profile')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>My Account <a href="{{url('user/profile/edit')}}"><i class='fa fa-pencil'></i></a></h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class="col col-md-4">
                    @if(!is_null(auth()->user()->avatar_url))
                        <img alt="{{ auth()->user()->username }}" class=" thumbnail img-responsive" src="{{ auth()->user()->avatar_url }}" />
                    @else
                        <img alt="User Pic" src="http://www.expatica.com/images/default_avatar.jpg" class="thumbnail img-responsive">
                    @endif
                </div>
                <div class="col col-md-8">
                    <table class='table'>
                        <tr>
                            <td>Name</td>
                            <td><{{ auth()->user()->fname }} {{ auth()->user()->lname }} /td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td> {{ auth()->user()->email }} </td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td> {{ auth()->user()->role }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
