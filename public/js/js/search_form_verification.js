
$(document).ready(function(){
  $('#query').keydown(function(){
    if($('#query').val().trim() !== ''){
      $('#search-button').removeClass('btn-default');
      $('#search-button').addClass('btn-primary');
      $('#search-button').removeAttr('disabled');
    }
    else{
      $('#search-button').attr('disabled', 'true'); 
      $('#search-button').removeClass('btn-primary');
      $('#search-button').addClass('btn-default');
    }
  });
  $('form').submit(function(){
    if ($('#query').val().trim() == '') {
        return false;
    } else {
      return true;
    }
  });
});