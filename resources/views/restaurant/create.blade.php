@extends('dashboard.index')

@section('title', 'Add Restaurant')

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Create restaurant</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class="col col-md-12">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form  method="POST" action="/restaurants/add">

                        {{ csrf_field() }}
                        <div class='row'>
                            <div class='col col-md-6'>
                                <div class= "form-group">
                                    <label for= "name" class= "control-label visible-sm"> Name of restaurant</label>
                                    <input type = "text" class = "form-control" id= "restaurant_name"
                                            placeholder = "Enter name" name= "name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class='col col-md-6'>
                                <div class= "form-group">
                                    <label for = "location" class= "control-label visible-sm"> Location</label>
                                    <input type = "text" class = "form-control" id= "location" name="location" placeholder = "Enter physical location" value="{{ old('location') }}">
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col col-md-6'>
                                <div class = "form-group">
                                    <label for = "email-address" class = "control-label visible-sm"> Email address</label>
                                    <input type = "email" class = "form-control" name="email" id = "email-address"
                                    value="{{ old('email') }}" placeholder = "Enter email address">
                                </div>
                            </div>

                            <div class='col col-md-6'>
                                <div class = "form-group">
                                    <label for = "postal" class = "control-label visible-sm"> Postal address</label>
                                    <input type = "text" class = "form-control" name="address" id = "postal"
                                    value="{{ old('address') }}" placeholder = "Enter postal address">
                                </div>
                            </div>
                        </div>

                        <div class='row'>
                            <div class='col col-md-3'>
                                <div class = "form-group">
                                    <label for = "opening-hours" class = "control-label visible-sm"> Opening Time</label>
                                    <input type='text' class = "form-control" id = "opening-hours" name="opening_time" placeholder = "09:00 (In 24hr system)" value="{{ old('opening_time') }}">
                                </div>
                            </div>
                            <div class='col col-md-3'>
                                <div class = "form-group">
                                    <label for = "closing-time" class = "control-label visible-sm"> Closing Time</label>
                                    <input type='text' class = "form-control" id = "closing-time" name="closing_time" placeholder = "22:00" value="{{ old('closing_time') }}">
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class = "form-group">
                                    <label for = "telephone" class = "control-label visible-sm"> Telephone Number</label>
                                    <input type = "text" class = "form-control" id = "telephone"
                                    name="telephone" placeholder = "Enter phone number" value="{{ old('telephone') }}">
                                </div>
                            </div>
                            <div class="col col-md-3">
                                <div class = "form-group">
                                    <label for = "refund_rate" class = "control-label visible-sm"> Refund Rate</label>
                                    <input type = "number" class = "form-control" id = "refund_rate"
                                    name="refund_rate" placeholder = "Default is 0%." value="{{ old('refund_rate') }}">
                                </div>
                            </div>
                        </div>

                        <div class ="form-group">
                            <label for= "cuisine" class= "control-label visible-sm"> Description</label>
                            <textarea class = "form-control" name= "description" id = "cuisine" rows= "5" placeholder = "e.g. cuisine and selling point">{{ old('description') }}</textarea>
                        </div>

                        <div class = "form-group">
                            <button type = "submit" class = "btn btn-primary btn-lg" style="float:right">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
