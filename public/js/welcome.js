$(document).ready(function() {
    $("#featured-restaurant-scroller").owlCarousel({
        items: 4,
        navigation:false,
        lazyLoad:true,
        stopOnHover:true,
        autoPlay:3000
    });

    // $('#featured-restaurant-scroller .info').ellipsis({
    // row:3
    // });

   var scroll_start = 0;
   var startchange = $('#hero');
   var offset = startchange.offset();
   if (startchange.length){
   $(document).scroll(function() {
      scroll_start = $(this).scrollTop();
      
      if(scroll_start > 41) {
          $(".navbar-fixed-top").addClass('navbar-default');
       } else {
          $('.navbar-fixed-top').removeClass('navbar-default');
       }
   });
    }
});
