$(document).ready(function() {

    $("#changePasswordLink").click(function() {
        $( "#changePasswordForm" ).toggle("slow");
    });

    $("#changePasswordButton").click(function(e) {

        e.preventDefault();
        var oldPassword = $("#oldPassword").val().trim();
        var newPassword = $("#newPassword").val().trim();
        var newPasswordConfirm = $("#newPasswordConfirm").val().trim();
        messages = verifyPassword(oldPassword, newPassword, newPasswordConfirm);
        if (messages != '<ul></ul>') {
            $("#response").removeClass().addClass('response-error').html(messages);
            return false;
        } else {
            var formData = $(this).parents("#changePasswordForm").find("input");
            submitForm(formData);
        }
    });

    function submitForm(formData) {
        $.ajax({
            type: 'POST',
            url: '/changepassword',
            data: formData,
            dataType: 'json',
            success: function (data) {
                if (data.error === true) {
                    var message = prepare(data.message);
                    $("#response").show().fadeIn(3000);
                    $("#response").removeClass().addClass('response response-error').html(message);
                } else {
                    $( "#changePasswordForm" )[0].reset();
                    $( "#changePasswordForm" ).hide();
                    $("#response").removeClass().addClass('response response-success').html(data.message).fadeOut(3000);
                    alertify.success(data.message);
                }
            }
        })
    }

    var prepare = function (messages) {
        var message = '<ul>';
        var size = messages.length;
        for (var i = 0; i < size; i++) {
            message += '<li>' + messages[i] + '</li>';
        }
        message += '</ul>';
        return message;
    }

    var verifyPassword = function (old, first, second) {
        messages = '<ul>';
        if ( old === '' || first === '' || second === '' ) {
            messages += '<li>Passwords cannot be empty</li>';
        } else if (first.length < 6) {
            messages += '<li>Password Too Short</li>';
        }
        if (first !== second) {
            messages += '<li>New password must match confirmation.</li>';
        }
        messages += '</ul>';
        return messages;
    }
});