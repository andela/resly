$(document).ready(function() {
  $("#featured-restaurant-scroller").owlCarousel({
    items: 4,
    navigation:true,
    lazyLoad:true,
    stopOnHover:true,
    autoPlay:3000
  });

  $('#featured-restaurant-scroller .info').ellipsis({
    row:3
  });
});