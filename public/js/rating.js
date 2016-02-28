$(document).ready(function () {
    $("#demo1 .stars").click(function () {
        var rating = $(this).val();
        var restaurant_id = $(this).parent().attr('data-id');
        $.post('/restaurants/'+ restaurant_id +'/rate',{rate: rating},function(d){
            var result = JSON.parse(d);
            if (result.status == 'success') {
                updateStars(parseInt(result.avg_rating), parseInt(rating), restaurant_id)
                alert('Restaurant has been rated');
            } else {
                alert('Restaurant rating failed'); 
            }
        });
    });
    function updateStars(avg_rating, user_rating, res)
    {
        //update user rating
        user_rating_output = '';
        for (var i=0; i<user_rating; i++) {
            user_rating_output += "<i class='fa fa-star' style='color:#FFD700'></i>";
        }
        $('#user_rating_'+res).html(user_rating_output);
    }
});