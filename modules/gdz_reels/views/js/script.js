
$(document).ready(function() {
    var isMobile = $(window).width() <= 991;
    var h = 500;
    function visible($t) {
        let $w            = $(window);
        let viewTop       = $w.scrollTop();
        let viewBottom    = viewTop + $w.height();
        let _top          = $t.offset().top;
        let _bottom       = _top + $t.height();
        let compareTop    = _bottom;
        let compareBottom = _top;
        return ((compareBottom <= viewBottom) && (compareTop >= viewTop));
    }
    function play(wrap) {
        video = wrap.find('.reel_video').get(0);
        wrap.find('.fa').removeClass('fa-play').addClass('fa-pause');
        btn = wrap.find('.play');
        // $(this).fadeOut(500);
        btn.data('playing', true);
        btn.data('interact', true);
        // video.play();
        btn.removeClass('show_play').addClass('hide_play');
    }
    function pause(wrap) {
        video = wrap.find('.reel_video').get(0);
        wrap.find('.fa').removeClass('fa-pause').addClass('fa-play');
        btn = wrap.find('.play');
        btn.data('playing', false);
        // video.pause();
        btn.removeClass('hide_play').addClass('show_play');
    }
    // $('.play .fa').click(function() {
    //     wrap = $(this).closest('.video');
    //     video = wrap.find('.reel_video').get(0);
    //     btn = wrap.find('.play');
    //     if (btn.data('playing')) {
    //         pause(wrap);
    //     } else {
    //         play(wrap);
    //     }
    // })
    function next(products, currentIndex) {
        if (currentIndex+1 >= products.length) {
            return 0;
        } else {
            return currentIndex+1;
        }
    }
    function prev(products, currentIndex) {
        return currentIndex-1;
    }
    function repeat(reel)
    {
        isMobile = $(window).width() <= 991;
        $(reel).data('show', false);
        $(reel).find('.lookbooks').scrollTop(0);
        $(reel).find('.lookbook-product').each(function(i, product) {
            let animate = $(product).attr('animate');
            $(product).removeClass(animate).css({
                'opacity': 0,
                'pointer-events': 'none',
            }).removeClass('fadeOutUp');
        })
        $(reel).find('.lookbook').removeClass('show');
        setHeight(reel);
        show(reel);
    }
    function slide(products, index) {
        let product = products[index];
        let duration = parseInt($(product).attr('duration'));
        let animte = $(product).attr('animate');
        if (isMobile) {
            let nextIndex = next(products, index);
            let prevIndex = prev(products, index);
            setTimeout(function() {
                if (prevIndex < 0) {
                    $(product).css({
                        'opacity': 1,
                        'pointer-events': 'all',
                    }).addClass(animte);
                } else if (prevIndex > -1 && prevIndex < products.length -1) {
                    $(products[prevIndex]).removeClass('animated').removeClass(animte).addClass('animated fadeOutUp');
                }
            } , 1000*duration);
        } else {
            setTimeout(function() {
                if (!$(product).closest('.lookbook').hasClass("show")) {
                    $(product).closest('.lookbook').addClass('show');
                }
                $(product).css({
                    'opacity': 1,
                    'pointer-events': 'all',
                }).addClass(animte);
                let nextIndex = next(products, index);
                if (isMobile) {
                    let prevIndex = prev(products, index);
                    if (prevIndex < products.length -1) {
                        $(products[prevIndex]).removeClass('animated').removeClass(animte).addClass('animated fadeOutUp');
                    }
                }
                if (nextIndex) {
                    slide(products, nextIndex);
                }
            } , 1000*duration);
        }
    }
    function show(reel) {
        if ($(reel).data('show')) {
            return;
        } else {
            $(reel).data('show', true);
        }
        let products = $(reel).find('.lookbook-product').get();
        slide(products, 0);
    }
    function setHeight(reel) {
        if ($(reel).find('iframe').length) {
            h = $(reel).find('iframe').height();
        } else {
            h = $(reel).find('video').height();
        }
        $(reel).find('.lookbooks').css({
            'max-height': h,
            'display': 'block',
        });
    }
    $(window).scroll(function() {
        $('.gdz_reel').each(function(i, e) {
            playing = $(this).find('.play').data('playing');
            interact = $(this).find('.play').data('interact');
            autoplay = parseInt($(this).attr('data-autoplay'));
            video = $(this).find('video').get(0);
            if (visible($(this))) {
                show(this);
                if (autoplay && !playing && !interact) {
                    video.play();
                }
            }
        })
    })
    $('.gdz-repeat').click(function(e) {
        reel = $(this).closest('.gdz_reel').get(0);
        repeat(reel);
        $(this).closest('.repeat').hide();
    })
    $('.gdz_reel').each(function(i, e) {
        let reel = $(this);
        let products = $(this).find('.lookbook-product');
        let productCount = products.length;
        if ($(this).find('iframe').length) {
            h = $(this).find('iframe').height();
            $(this).find('.lookbooks').css({
                'max-height': h,
                'display': 'block',
            });
        } else {
            reel.find('video').on( "loadedmetadata", function (e) {
                let h = e.target.videoWidth;
                reel.find('.lookbooks').css({
                    'max-height': h,
                    'display': 'block',
                });
            });
        }
        products.each((i, ele) => {
            $(ele).bind('oanimationend animationend webkitAnimationEnd', function(e) {
                if (isMobile) {
                    let index = i;
                    let nextIndex = next(products, index);
                    let animate = $(ele).attr('animate');
                    if (e.originalEvent.animationName == 'fadeOutUp') {
                        if (nextIndex)
                            $(products[nextIndex]).css({
                                'opacity': 1,
                                'pointer-events': 'all',
                            }).addClass(animate);
                    } else if (e.originalEvent.animationName == animate){
                        if (nextIndex)
                            slide(products, nextIndex);
                        else
                            $(ele).closest('.gdz_reel').find('.repeat').css('display', 'flex');
                    }
                } else {
                    if (products[i+1]) {
                        let nextProduct = products[i+1];
                        let productScroll = nextProduct.offsetTop+nextProduct.scrollHeight;
                        if (productScroll > h) {
                            let scroll = productScroll - h;
                            $(this).closest('.lookbooks').animate({scrollTop: scroll}, 500, 'swing');
                        }
                    } else {
                        $(ele).closest('.gdz_reel').find('.repeat').css('display', 'flex');
                    }
                }
            })
        });
        $(this).find('video').on('play', function(e) {
            play($(this).closest('.video'));
        })
        $(this).find('video').on('pause', function(e) {
            pause($(this).closest('.video'));
        })
    })
});
