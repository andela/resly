@extends('dashboard.index')

@section('title', 'Update Profile')

@section('details')
  <div class="container" style="padding-top:50px;">
      <div class="panel-body">
          <div class="row">
              <div class="col-md-3 col-lg-3 " align="center">
                @if(auth()->user()->avatar == null)
                  <img alt="User Pic" src="http://babyinfoforyou.com/wp-content/uploads/2014/10/avatar-300x300.png" class="img-circle img-responsive">
                @else
                  <img alt="User Pic" src="{{auth()->user()->avatar}}" class="img-circle img-responsive">
                @endif
              </div>
              <div class=" col-md-9 col-lg-9 ">
                <form class="form-vertical" role="form" method="post" action="{{ route('userProfileEdit') }}" enctype="multipart/form-data">
                  @include('partials.error')
                    <div class="form-group">
                        <label for="username" class="control-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="{{ old('username') ?: auth()->user()->username }}">
                    </div>
                    <div class="form-group">
                        <label for="fname" class="control-label">First name</label>
                        <input type="text" name="fname" class="form-control" id="fname" value="{{ old('fname') ?: auth()->user()->fname }}">
                    </div>
                    <div class="form-group">
                        <label for="lname" class="control-label">Last name</label>
                        <input type="text" name="lname" class="form-control" id="lname" value="{{ old('lname') ?: auth()->user()->lname }}">
                    </div>
                    <div class='form-group'>
                      <label for="avatar" class="control-label">Avatar</label>
                        <input type="file" name="avatar" id="avatar" >
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default">Update</button>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
              </div>
          </div>
      </div>
  </div>
@endsection