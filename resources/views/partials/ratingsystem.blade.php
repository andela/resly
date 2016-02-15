<style>
    /****** Rating Starts *****/
    @import url(http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css);

    fieldset, label { margin: 0; padding: 0; }

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


    /* Downloaded from http://devzone.co.in/ */
</style>
@section('scripts')
<script>
  $(document).ready(function(){
    $('.stars').click(function(){
      $rating = $(this).val();
      $.post(
        '/restaurant/{{$rest->id}}/rate',
        {
          rating: $rating
        },
        function(data, status){
          result = JSON.parse(data);
          if (result.output == 1) {
              $('#rating-system').hide();
              updateStars($rating, parseInt(result.ratings_avg));
              $('#your-rating').html($rating);
          } else {
              alert('You have already rated this restaurant');
          }
        }
      );
      console.log($(this).val());
    });
  });

  function updateStars(rating, avg_rating){
    console.log('updating stars');
    output = '';
    output_2 = '';
    for(i = 0; i < rating; i++){
      output += '<label class = "full" style="color:#FFA500 !important;"></label>';
    }
    for(j = 0; j < avg_rating; j++){
      output_2 += '<i class="fa fa-star yellow"></i>';
    }
    console.log(output);
    $('#my-rating').html(output);
    $('#avg_rating').html(output_2);
  }
</script>
@endsection

@if($hasNotRated)
<div id='rating-system'>
  <span><strong>Rate This restaurant</strong></span><br/>
  <div class='row' style="margin-left:0;">
    <fieldset class="rating">
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
  </div>
</div>
@endif

<span><strong>Your Rating</strong></span>
<div class='row' style="margin-left:0">
  <fieldset class="rating" id='my-rating'>
    @if (is_numeric($user_rating))
          @for($i=0; $i < $user_rating; $i++)
            <label class = "full" style="color:#FFA500 !important;"></label>
          @endfor
    @else
      {{$user_rating}}
    @endif
  </fieldset>
</div>
