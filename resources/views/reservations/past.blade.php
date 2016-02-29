@extends('dashboard.index')
@section('title', 'Current Reservations')

@section('styles')
    @parent
    <link rel='stylesheet' href="{{asset('css/rating.css')}}" />
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/rating.js')}}"></script>
@endsection

@section('details')
    <div class="row ">
        <div class='col col-md-12 page-title'>
            <h3>Past Reservations</h3>
        </div>
    </div>
    <div class='row'>
        <div class='col col-md-12 page-body'>
            <div class="row">
                <div class='col col-md-12'>
                    @include('partials.alerts')
                    @if(count($reservations) == 0)
                        <div class='not-available-label'>
                            <h3>You have no past reservations</h3>
                        </div>
                    @else
                        <table class='table'>
                        <thead>
                            <tr>
                                <th>Scheduled Date</th>
                                <th>Restaurant Name</th>
                                <th>Duration</th>
                                <th>Cost</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                            <tbody>
                                @foreach($reservations as $res)
                                        <tr>
                                            <td>{{$res->scheduled_date}}</td>
                                            <td>{{$res->restaurant()->name}}</td>
                                            <td>{{$res->duration}} hrs</td>
                                            <td>${{$res->cost}}</td>
                                            <td id='user_rating_{{$res->restaurant()->id}}'>
                                                @if($res->restaurant()->userHasNotRated())
                                                    <fieldset id='demo1' class="rating" data-id="{{$res->restaurant()->id}}">
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
                                                @else
                                                    @for($i = 0; $i < $res->restaurant()->userRating(); $i++)
                                                        <i class='fa fa-star' style='color:#FFD700'></i>
                                                    @endfor
                                                @endif
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
