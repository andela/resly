@extends('layouts.master')

@section('title', 'Profile')

@section('content')
  <div class="container" style="padding-top:50px;">
      <div class="row">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">{{ auth()->user()->username }}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive"> </div>
                  <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                      <tbody>
                        <tr>
                          <td>First Name:</td>
                          <td>{{ auth()->user()->fname }}</td>
                        </tr>
                        <tr>
                          <td>Last Name:</td>
                          <td>{{ auth()->user()->lname }}</td>
                        </tr>
                        <tr>
                          <td>Email:</td>
                          <td>{{ auth()->user()->email }}</td>
                        </tr>
                        <tr>
                          <td>Role:</td>
                          <td>{{ auth()->user()->role }}</td>
                        </tr>
                      </tbody>
                    </table>
                    <a href="/" class="btn btn-primary">Back to home</a>
                  </div>
              </div>
            </div>
          </div>
      </div>
  </div>
@endsection