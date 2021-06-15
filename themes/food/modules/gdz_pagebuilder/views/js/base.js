function triggerCarousel(carousel) {
    var c_lazyload = false;
    // console.log(typeof gdzSetting);
    if(typeof gdzSetting !== 'undefined') {
        var c_lazyload = gdzSetting.carousel_lazyload;
    }
    carousel.owlCarousel({
        loop:false,
        margin:carousel.data("margin"),
        nav:carousel.data("nav"),
        dots:carousel.data("dots"),
        autoplay:carousel.data("auto"),
        rewind:carousel.data("rewind"),
        slideBy:carousel.data("slidebypage"),
        lazyLoad:c_lazyload,
        navText: ['<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.7051 7.41L11.1251 12L15.7051 16.59L14.2951 18L8.29508 12L14.2951 6L15.7051 7.41Z" fill="#3F2803" fill-opacity="0.7"/></svg>','<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.29492 16.59L12.8749 12L8.29492 7.41L9.70492 6L15.7049 12L9.70492 18L8.29492 16.59Z" fill="#3F2803" fill-opacity="0.7"/></svg>'],
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
  