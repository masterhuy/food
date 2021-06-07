function triggerCarousel(carousel) {
  var c_lazyload = false;
  // console.log(typeof gdzSetting);
  if(typeof gdzSetting !== 'undefined') {
    var c_lazyload = gdzSetting.carousel_lazyload;
  }
  carousel.owlCarousel({
    loop:true,
    margin:carousel.data("margin"),
    nav:carousel.data("nav"),
    dots:carousel.data("dots"),
    autoplay:carousel.data("auto"),
    rewind:carousel.data("rewind"),
    slideBy:carousel.data("slidebypage"),
    lazyLoad:c_lazyload,
    responsive: {
      0:{
        items:carousel.data("xs")
      },
      576:{
        items:carousel.data("sm")
      },
      992:{
        items:carousel.data("md")
      }
    }
  });
}
jQuery(function ($) {
    $.each( $('.owl-carousel'), function( key, value ) {
        carousel = $(this);
        triggerCarousel(carousel);
    });

    $.each( $('.countdown'), function( key, value ) {
      var $expire_time = $(this).html();
      var _datetime = $expire_time.split(" ");
      var _date = _datetime[0];
      var _time = _datetime[1];
      var datestr = _date.split("-");
      var timestr = _time.split(":");
      var austDay = new Date(datestr[0], datestr[1]-1, datestr[2], timestr[0], timestr[1], timestr[2],0);
      $(this).countdown({until: austDay});
    });
});
