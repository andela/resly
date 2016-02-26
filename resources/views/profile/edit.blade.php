@extends('dashboard.index')

@section('title', 'Update Profile')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Update Account Details</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class="col col-md-4">
                    @if(auth()->user()->avatar !== null)
                        <img alt="{{ auth()->user()->username }}" class=" thumbnail img-responsive" src="{{ auth()->user()->avatar }}" />
                    @else
                        <img alt="User Pic" src="http://www.expatica.com/images/default_avatar.jpg" class="thumbnail img-responsive">
                    @endif
                </div>
                <div class='col col-md-8'>
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
