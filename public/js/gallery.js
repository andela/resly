$(function() {
    $('#uploadFile').click(function(e) {
        $('#fileUploadField').click();
        $('#filename').text('File added!');
        e.preventDefault();
    });

});
$(document).ready(function() {
    $('.fancybox').fancybox();
    $(document.body).on('click', '.delete-link', function(e){
        var element = $(this);
        $.ajax({
            url: "{!! url('gallery') !!}/"+element.attr('data-id'),
            type: "DELETE",
            beforeSend: function(){
                if (confirm("Are you sure you want to delete this picture?") == false) {
                    return false;
                }
                element.parent().css('opacity', 0.6);
                element.removeClass('fa');
                element.removeClass('fa-times');
                element.html('deleting picture...');
            },
            success: function(result){
                element.parent().remove();
            }
        }
        );
        e.preventDefault();
    });
});

//jquery forms
(function() {

var bar = $('.progress-bar');
var percent = $('.percent');
var status = $('#status');
var errStatus = $('#errStatus');
var prog_bar = $('.progress');

$('form').ajaxForm({
    beforeSend: function() {
        status.empty();
        var percentVal = '0%';
        bar.width(percentVal)
        percent.html(percentVal);
        prog_bar.show();
    },
    uploadProgress: function(event, position, total, percentComplete) {
        if(parseInt(percentComplete) > 98){
            percentComplete = parseInt(percentComplete) - 5;
        } else {
            percentComplete = parseInt(percentComplete);
        }
        var percentVal = percentComplete.toString() + '%';
        bar.width(percentVal)
        percent.html(percentVal);
    },
    error: function(data){
        $('#uploadFailure').show();
        var errors = JSON.parse(data.responseText).image[0];
        errStatus.html(errors);
        console.log(errors);
        // Render the errors with js ...

        bar.width('20%');
        bar.addClass('progress-bar-danger');
        percent.html('failed');
    },
    success: function(result) {
        //insert new object
        parent = $(".con").children().first();
        parent.addClass('random');
    },
    complete: function(xhr){
        console.log(xhr);
        console.log(JSON.parse(xhr.responseText));
        result = JSON.parse(xhr.responseText);
        if (result.status == 'successful'){
            var percentVal = '100%';
            bar.width(percentVal);
            percent.html(percentVal);
            prog_bar.hide();
            $('#uploadSuccess').show();
            status.html("Upload Complete!!");
            new_element = '<div class = "col-md-3" style="text-align:center;">';
            new_element += '<a class = "fancybox" href="http://res.cloudinary.com/ddnvpqjmh/image/upload/' +result.filename+'"';
            new_element += 'data-fancybox-group="gallery" title="'+result.caption+'">';
            new_element += '<img class = "gallery-thumbnail" src="http://res.cloudinary.com/ddnvpqjmh/image/upload/c_fill,h_300,w_300/'+result.filename+'"/></a>';
            new_element += '<a class ="fa fa-times delete-link" href="#" data-id ="'+result.pic_id+'"> Delete Image</a></div>';
            new_element += '</div>';
            if( $('.con').html().trim() == '') {
                $('.con').html(new_element);
            } else {
                $(new_element).insertBefore('.random');
            }
        } else {
            console.log('completed but failed');
        }

    }
});

})();
