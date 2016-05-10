$(document).ready(function () {

    $('#submitRating').click(function (e) {
        e.preventDefault();

        var rating = $("#rating_value").val();
        var restaurant_id = $("#rated_restaurant").attr('value');
        var booking = $("#rated_booking").val();
        var comment = $("#rating_comment").val().trim();
        if (comment === '') {
            alertify.error("Comment cannot be empty");
            return false;
        }

        $.post('/restaurants/'+ restaurant_id + '/rate/',{rate: rating, comment: comment, booking: booking}, function(d){
                    var result = JSON.parse(d);
                    if (result.status == 'success') {
                        updateStars(parseInt(result.avg_rating), parseInt(rating), restaurant_id, booking)
                        alertify.success("Thank you for rating.");
                        clearRatingForm();
                    } else if (result.status == 'failure') {
                        alertify.error(result.message);
                    } else {
                        alertify.error('Restaurant rating failed');
                    }
        });


    });

    $("#demo1 .full").click(function () {
        var labelFor = $(this).attr('for');
        var rating = $("#" + labelFor).val();
        var booking = $(this).parent().attr('booking');
        var restaurant_id = $(this).parent().attr('data-id');
        $('#rated_restaurant').attr('value', function () {return restaurant_id});
        $('#rating_value').attr('value', function () {return rating});
        $('#rated_booking').attr('value', function () { return booking});
        $('#rateTrigger').trigger('click');
    })

    function clearRatingForm()
    {
        // clear th form
        $('#rating_comment_form')[0].reset();
        $('#closeRating').trigger('click');
    }


    function updateStars(avg_rating, user_rating, res, booking)
    {
        //update user rating
        user_rating_output = '';
        for (var i=0; i<user_rating; i++) {
            user_rating_output += "<i class='fa fa-star' style='color:#FFD700'></i>";
        }
        $('#user_rating_'+res+'_'+booking).html(user_rating_output);
    }
});