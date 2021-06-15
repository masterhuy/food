$(document).ready(function() {
    $('.pb-instagram').each(function(){
        var pb_instagram = $(this);
        optionData = pb_instagram.attr('data-option');
        if (optionData) {
            var options = JSON.parse(pb_instagram.attr('data-option'));
            if(options.view_type == 'carousel') {
                var $carousel = pb_instagram.find('.pb-instagram-carousel');
                if ( ! $carousel.length ) {
                    return;
                }
                $carousel.owlCarousel({
                    loop:true,
                    margin:parseInt(options.gutter),
                    nav:$carousel.attr('data-nav'),
                    dots:$carousel.attr('data-dots'),
                    autoplay:$carousel.attr('data-auto'),
                    rewind:$carousel.attr('data-rewind'),
                    slideBy:$carousel.attr('data-slidebypage'),
                    lazyLoad:true,
                    responsive:{
                        0:{
                            items:$carousel.attr('data-xs')
                        },
                        576:{
                            items:$carousel.attr('data-sm')
                        },
                        992:{
                            items:$carousel.attr('data-md')
                        },
                        1199:{
                            items:$carousel.attr('data-items')
                        },
                    }
                });
                $carousel.addClass('owl-carousel');
            }
        }
    });
});
