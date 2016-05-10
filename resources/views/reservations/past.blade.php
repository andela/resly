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
                                            <td id='user_rating_{{$res->restaurant()->id}}_{{$res->id}}'>
                                                @if($res->restaurant()->userHasNotRated($res->id))
                                                    <fieldset id='demo1' class="rating" data-id="{{$res->restaurant()->id}}" booking="{{$res->id}}">
                                                        @include('partials.rating_fields')
                                                    </fieldset>
                                                    <div style="clear:both"></div>
                                                @else
                                                    @for($i = 0; $i < $res->restaurant()->userRating($res->id); $i++)
                                                        <i class='fa fa-star' style='color:#FFD700'></i>
                                                    @endfor
                                                @endif
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif



<!-- Button trigger modal -->
<a id="rateTrigger" data-toggle="modal"
   data-target="#myModal" data-id="" style="display: none;">
</a>
<!-- Modal -->
<div class="modal fade" style="display: none;" id="myModal" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title" id="myModalLabel">Rate this restaurant</h3>
        </div>
         <div class="modal-body">
            <form id="rating_comment_form" method="post">
            <div class="row">
                <div class="col-md-4"><input type="text" id="rated_restaurant" hidden readonly value="" /></div>
                <div class="col-md-4"><input type="text" id="rated_booking" hidden readonly value="" /></div>
                <div class="col-md-4"><input type="text" id="rating_value" hidden readonly value="" /></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <textarea required id="rating_comment" class="rating_comment" name="rating_comment" placeholder="Enter a comment"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <button type="button" class="btn btn-default pull-right rating_button" id="closeRating" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary pull-right rating_button" id="submitRating">Rate</button>
                    </div>
                </div>
            </div>
            </form>
         </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>

                </div>
            </div>
        </div>
    </div>
@endsection
