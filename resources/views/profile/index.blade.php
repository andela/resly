@extends('layouts.master')

@section('title', 'Results')

@section('styles')
<link rel="stylesheet" type="text/css" href="{!! asset('css/auth.css') !!}">
<style>

            .rating { 
                border: none;
                float: left;
            }

            .rating > input { display: none; } 
            .rating > label:before { 
                margin: 5px;
                font-size: 1.25em;
                font-family: FontAwesome;
                display: inline-block;
                content: "\f005";
            }

            .rating > .half:before { 
                content: "\f089";
                position: absolute;
            }

            .rating > label { 
                color: #ddd; 
                float: right; 
            }

            .rating > input:checked ~ label, 
            .rating:not(:checked) > label:hover,  
            .rating:not(:checked) > label:hover ~ label { color: #FFD700;  }

            .rating > input:checked + label:hover, 
            .rating > input:checked ~ label:hover,
            .rating > label:hover ~ input:checked ~ label, 
            .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }     
        </style>
@endsection

@section('content')
    @include ('partials.alerts');
    <div class="row">
        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
    <div class="container">
        
        <div class="col-lg-9 white">
            <h2>Welcome to {{$rest->name}} 
            @if($rest->averageRating == 0)
                <span id='avg_rating'><i class='fa fa-star' style='color:#999;'></i></span>
            @else
                <span id='avg_rating'>
                    @for($i = 0; $i < intval($rest->averageRating); $i++)
                        <i class='fa fa-star' style='color:#FFD700'></i>
                    @endfor
                </span>
            @endif
            </h2>
            <p>{{$rest->location}}<p>
            <p>{{$rest-> opening_time}}</p>

            @can('authenticated')
                <strong>Rate this restaurant</strong><br/>
                <fieldset id='demo1' class="rating">
                    <input class="stars" type="radio" id="star5" name="rating" value="5" />
                    <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                    <input class="stars" type="radio" id="star4" name="rating" value="4" />
                    <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                    <input class="stars" type="radio" id="star3" name="rating" value="3" />
                    <label class = "full" for="star3" title="Meh - 3 stars"></label>
                    <input class="stars" type="radio" id="star2" name="rating" value="2" />
                    <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                    <input class="stars" type="radio" id="star1" name="rating" value="1" />
                    <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                </fieldset>
                <div style="clear:both"></div>
            @endcan
            
            <strong>Your Rating</strong><br/>
            @can('authenticated')
                @if($user_rating == null)
                    <span id='user_rating' style='color:red;'>You have not rated this restaurant</span>
                @else
                    <span id='user_rating'>
                        @for($i=0; $i<$user_rating; $i++)
                            <i class='fa fa-star' style='color:#FFD700'></i>
                        @endfor
                    </span>
                @endif
            @endcan
            @if(!Auth::check())
                You need to sign in to rate
            @endif


        </div>


        <div class="col-lg-3 white">
            <h2> Availability </h2>

            <form method="POST" action="/bookings/begin">
            {{csrf_field()}}
            <input type="hidden" name="restaurant_id" value="{{$rest->id}}">
            <div class="form-group">
                <label for="inputNumberOfPeople">Number of people</label>
                <input type="number" class="form-control" id="inputNumberOfPeople" name="number_of_people" placeholder="1">
            </div>
            <div class="form-group">
                <label for="inputBookingDate">Booking date</label>
                <input type="date" class="form-control" id="inputBookingDate" placeholder="dd/mm/yy" name="booking_date">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#demo1 .stars").click(function () {
                var rating = $(this).val();
                $.post('/restaurants/{{$rest->id}}/rate',{rate: rating},function(d){
                    var result = JSON.parse(d);
                    if (result.status == 'success') {
                        updateStars(parseInt(result.avg_rating), parseInt(rating))
                        alert('Restaurant has been rated');
                    } else {
                        alert('Restaurant rating failed'); 
                    }
                });
            });

            function updateStars(avg_rating, user_rating)
            {
                //update user rating
                user_rating_output = '';
                for (var i=0; i<user_rating; i++) {
                    user_rating_output += "<i class='fa fa-star' style='color:#FFD700'></i>";
                }
                $('#user_rating').html(user_rating_output);

                //update average rating
                avg_rating_output = '';
                for (var j=0; j<avg_rating; j++) {
                    avg_rating_output += "<i class='fa fa-star' style='color:#FFD700'></i>";
                }
                $('#avg_rating').html(avg_rating_output);
            }
        });
    </script>
@endsection