<div style="display: inline;">
    @if($restaurant->averageRating() == null)
        <span id='avg_rating'><i class='fa fa-star' style='color:#999;'><small> unrated</small></i> </span>
    @else
        <span id='avg_rating'>
            @for($i = 0; $i < intval($restaurant->averageRating()); $i++)
                <i class='fa fa-star' style='color:#FFD700'></i>
            @endfor
            @for($i = 0; $i < 5 - intval($restaurant->averageRating()); $i++)
                <i class='fa fa-star' style='color:#999'></i>
            @endfor
        </span>
    @endif
</div>