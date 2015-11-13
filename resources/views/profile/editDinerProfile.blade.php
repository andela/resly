@extends('layouts.master')

@section('title', 'Edit Profile')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/diner-profile.css') !!}">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css">
@endsection

@section('content')
    <div class = "container">
        <div class="profile-diner">
            <h1>Edit Profile</h1>
            <hr>

            <div class="row">
                <!-- left column -->
                <div class="col-md-3">
                    <!-- form for uploading picture -->
                    <form action="{{ route('diner_upload_photo', $diner->username) }}"
                          method="POST" 
                          class="dropzone"
                          id="dinerPic"
                    >
                    </form>
                </div> <!-- end of .col-md-3 -->

                <!-- edit form column -->
                <div class="col-md-9">
                    <h3>Personal info</h3>

                    {!! Form::model($diner,['method' => 'PATCH', 'route' => ['profile.update', $diner->username]]) !!}
                        <!--First name -->
                        <div class="form-group {{$errors->has('fname')?'has-error':''}}">
                            {!! Form::label('fname', 'First name', ['class' => 'control-label']) !!}
                            {!! Form::text('fname', null, ['class' => 'form-control']) !!}
                            @if($errors->has('fname'))
                                <span class = "help-block">
                                    {{$errors->first('fname')}}
                                </span>
                            @endif
                        </div>

                        <!-- Last name -->
                        <div class="form-group {{$errors->has('lname')?'has-error':''}}">
                            {!! Form::label('lname', 'Last name', ['class' => 'control-label']) !!}
                            {!! Form::text('lname', null, ['class' => 'form-control']) !!}
                            @if($errors->has('lname'))
                                <span class = "help-block">
                                    {{$errors->first('lname')}}
                                </span>
                            @endif
                        </div> 

                        <!-- Email Address -->
                        <div class="form-group {{$errors->has('email')?'has-error':''}}">
                            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
                            {!! Form::email('email', null, ['class' => 'form-control']) !!}
                            @if($errors->has('email'))
                                <span class = "help-block">
                                    {{$errors->first('email')}}
                                </span>
                            @endif
                        </div>

                         <div class="form-group {{$errors->has('username')?'has-error':''}}">
                            {!! Form::label('username', 'Username', ['class' => 'control-label']) !!}
                            {!! Form::text('username', null, ['class' => 'form-control']) !!}
                            @if($errors->has('username'))
                                <span class = "help-block">
                                    {{$errors->first('username')}}
                                </span>
                            @endif
                        </div>

                        <!-- Password -->
                        <div class="form-group {{$errors->has('password')?'has-error':''}}">
                            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
                            {!! Form::password('password', null, ['class' => 'form-control']) !!}
                            @if($errors->has('password'))
                                <span class = "help-block">
                                    {{$errors->first('password')}}
                                </span>
                            @endif
                        </div> 

                        <!-- Confirm Password -->
                        <div class="form-group {{$errors->has('confirm-password')?'has-error':''}}">
                            {!! Form::label('confirm-password', 'Confirm Password', ['class' => 'control-label']) !!}
                            {!! Form::password('confirm-password', null, ['class' => 'form-control']) !!}
                            @if($errors->has('confirm-password'))
                                <span class = "help-block">
                                    {{$errors->first('confirm-password')}}
                                </span>
                            @endif
                        </div>

                        <!-- Buttons -->
                        <div class="form-group">
                            {!! Form::submit('Save Changes', array('class' => 'btn btn-primary')) !!}
                            {!! Form::reset('Reset', array('class' => 'btn btn-danger')) !!}
                        </div>
                    {!! Form::close() !!}
                </div> <!-- col-md-9 -->       
            </div> <!-- end of .row -->
        </div> <!--end of .profile -->
        <hr>
    </div> <!-- end of .container -->
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.dinerPic = {
            paramName: 'photo',
            maxFilesize: 1,
            acceptedFiles: '.jpg, .jpeg, .png, .bmp',
            maxFiles: 1,
            init: function() {
                this.on("maxfilesexceeded", function(file) {
                this.removeAllFiles();
                this.addFile(file);
                });
            }
        };
    </script>
@endsection