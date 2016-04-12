$(document).ready(function () {
    var res;
    $(".confirm").click(function () {
        res = $(this).attr('id');
    });
    $(".confirm").confirm({
            text: "Are you sure that you want to cancel this reservation?",
            title: "Cancel Reservation",
            confirm: function(button) {
                location.href = '/cancel/' + res;
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
});