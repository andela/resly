
$(document).ready(function(){
   //http://stackoverflow.com/questions/10087819/convert-date-to-another-timezone-in-javascript
  function toTimeZone(time, zone) {
    var format = 'DD/MM/YYYY H:mm';
    return moment(time, format).tz(zone).format(format);
  }

  $('.fancybox').fancybox();
  $('form').submit(function(){
      var msg = "";
      //Parse the date from the form book date form field
      var bookDate = moment($('#bookDate').val(),"DD/MM/YYYY H:mm", true);
      if(!bookDate.isValid()){
        msg = "The date specified is not valid."
        alertify.error(msg);
        
        return false;
      }
      //Get 30mins from now.
      var next30MinsFromNow = moment().add(30, 'minutes').seconds(0);

      var maxDate = moment.max(bookDate,next30MinsFromNow);
      if(maxDate.diff(bookDate, 'minutes') > 0){
        msg = "The specified date and time must be greater than or equal to the next 30mins from now.";
        alertify.error(msg);

        return false;
      }
      //Convert to UTC for server
      $('#bookDate').val(toTimeZone($('#bookDate').val(),'UTC'));
    });
    
    jQuery('.bookDate').datetimepicker({
      format:'d/m/Y H:i',
      lang:'eng',
      minDate: moment().format('YYYY/MM/D')
    });
});