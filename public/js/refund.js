$(document).ready(function () {
    var res;
    var offset;
    $(".confirm").click(function (e) {
        e.preventDefault();

        res = $(this).attr('id');
        offset = prepareDate();
    });
    $(".confirm").confirm({
            text: "Are you sure that you want to cancel this reservation?",
            title: "Cancel Reservation",
            confirm: function(button) {
                $.post('/booking/cancel', {res: res, offset: offset}, function( d ) {
                    var result = JSON.parse(d);
                    if (result.status == 'success') {
                        id = result.res;
                        alertify.success("Thank you for rating.");
                        location.reload();
                    } else {
                        alertify.error(result.message);
                    }
                });
            }.bind($(".confirm")),
            cancel: function(button) {
                // nothing to do
            },
            confirmButton: "Yes I am",
            cancelButton: "No",
            post: true,
            confirmButtonClass: "btn-danger confirm-cancel",
            cancelButtonClass: "btn-default reject-cancel",
            dialogClass: "modal-dialog modal-lg" // Bootstrap classes for large modal
    });

    var updateStars = function (id) {
        $('#'+id).html();
        user_rating_output = '';
        for (var i=0; i<user_rating; i++) {
            user_rating_output += "<i class='fa fa-star' style='color:#FFD700'></i>";
        }
        $('#user_rating_'+res+'_'+booking).html(user_rating_output);
    }

    var prepareDate = function () {
        time = new Date();
        Y = setFig(time.getFullYear());
        m = setFig(time.getMonth() + 1);
        d = setFig(time.getDate());
        H = setFig(time.getHours());
        i = setFig(time.getMinutes());
        s = setFig(time.getSeconds());
        offset = Y+'-'+m+'-'+d+' '+H+':'+i+':'+s;
        return offset;
    }

    var setFig = function (fig) {
        fig < 10 ? fig = (0+''+fig) : fig = fig;
        return fig;
    }
});