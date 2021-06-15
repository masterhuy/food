jQuery(function ($) {
    'use strict';
    //header sticky
    var win = $(window),
        header = $('.header-sticky');
    if (header.length > 0) {
        var offset = header.offset().top;
        win.scroll(function () {
        if (offset < win.scrollTop()) {
            header.addClass('sticky');
        } else {
            header.removeClass('sticky');
        }
        });
    }
    //search
    $('.btn-search-full').click(function () {
        $('#search-form-full').toggleClass('open');
    });
    $('.search-box-close').click(function () {
        $('#search-form-full').removeClass('open');
    });
    //sidebar
    $('#sidebar-btn').click(function () {
        if ($('#header-sidebar').hasClass('right-sidebar'))
        $('body').toggleClass('sidebar-right-open');
        else $('body').toggleClass('sidebar-left-open');
    });
    $(document).on('click', function () {
        if ($('body').hasClass('sidebar-right-open'))
        $('body').removeClass('sidebar-right-open');
        if ($('body').hasClass('sidebar-left-open'))
        $('body').removeClass('sidebar-left-open');
    });
    $('#header-sidebar, #sidebar-btn').on('click', function (e) {
        e.stopPropagation();
    });

    //product image zoom
    $('.product-image-zoom').elevateZoom({
        zoomType: 'inner',
        cursor: 'crosshair',
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750,
    });

    //testimonial center mode
    if($(".pb-testimonial-carousel.center-image").length) {
		var testimonialCarousel = $(".pb-testimonial-carousel.center-image");
        var rtl = false;
        var lazyload_img = false;
        if(gdzSetting.carousel_lazyload)
        var lazyload_img = true;
        testimonialCarousel.addClass("owl-carousel");
		if ($("body").hasClass("rtl")) rtl = true;
		testimonialCarousel.owlCarousel({
			center: true,
            rtl:rtl,
            loop:true,
            margin: 75,
            nav: true,
            dots:false,
            autoplay:false,
            lazyLoad:lazyload_img,
            navText: ['<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15.7051 7.41L11.1251 12L15.7051 16.59L14.2951 18L8.29508 12L14.2951 6L15.7051 7.41Z" fill="#3F2803" fill-opacity="0.7"/></svg>','<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.29492 16.59L12.8749 12L8.29492 7.41L9.70492 6L15.7049 12L9.70492 18L8.29492 16.59Z" fill="#3F2803" fill-opacity="0.7"/></svg>'],
            responsive:{
                0:{
                    items: 1
                }
            }
		});
	}
});

$(document).mouseup(function (e) {
    var container = $('.search-box');
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.closest('.search-overlay').removeClass('open');
    }
});

$(document).on('click', '.switch-view', function (e) {
    $('.switch-view').removeClass('active');
    $(this).addClass('active');
    if ($(this).hasClass('view-grid')) {
        $('#product_list').removeClass('products-list');
        $('#product_list').addClass('products-grid');
    } else {
        $('#product_list').removeClass('products-grid');
        $('#product_list').addClass('products-list');
    } 
});

$(document).on('click', '.dropdown-menu', function (e) {
    e.stopPropagation();
});

function changeShopGrid() {
    var shop_grid_column = gdzSetting.shop_grid_column;
    if($('#product_list').attr('data-grid')) {
        shop_grid_column = $('#product_list').attr('data-grid');
    }
    if (jQuery(window).width() < 480) {
        $('.products-grid').removeClass('grid-1 grid-2 grid-3 grid-4');
        $('.products-grid').addClass('grid-1');
    } else if (jQuery(window).width() < 768) {
        $('.products-grid').removeClass('grid-1 grid-2 grid-3 grid-4');
        $('.products-grid').addClass('grid-2');
    } else if (jQuery(window).width() < 991) {
        $('.products-grid').removeClass('grid-1 grid-2 grid-3 grid-4');
        $('.products-grid').addClass('grid-3');
    } else {
        $('.products-grid').removeClass('grid-1 grid-2 grid-3 grid-4');
        $('.products-grid').addClass('grid-' + shop_grid_column);
    }
}
function footerCollapse() {
    if (jQuery(window).width() < 480 && gdzSetting.footer_block_collapse) {
        $('#footer-main').addClass('collapsed');
        $('#footer-main').find('.block-content').addClass('collapse');
    } else {
        $('#footer-main').removeClass('collapsed');
        $('#footer-main').find('.block-content').removeClass('collapse');
    }
}
jQuery(document).ready(function () {
    var menuItem = $('.gdz-megamenu .nav > .menu-item .mega-nav li');
        menuItem.each(function() {
        let dataGroup = $(this).attr('data-group');
        if(dataGroup == '0'){
            $(this).removeClass('group');
        }
    });
    $('.block_newsletter .alert').fadeOut(5000);
    // if ($(".gdz-megamenu").length > 0){
    //   $('.gdz-megamenu').jmsMegaMenu({
    //     event: 'click',
    //     duration: 100,
    //   });
    // }
    $('#hor-menu .gdz-megamenu').jmsMegaMenu({
        event: 'hover',
        duration: 100
    });
    $('.vermenu .gdz-megamenu').jmsMegaMenu({
        event: 'hover',
        duration: 100
    });
    $('.pb-menu .gdz-megamenu').jmsMegaMenu({
        event: 'hover',
        duration: 100
    });
    $('#off-canvas-menu .gdz-megamenu').jmsMegaMenu({
        event: 'click',
        duration: 100
    });
    changeShopGrid();
    footerCollapse();
});
jQuery(window).resize(function () {
    changeShopGrid();
    footerCollapse();
});

$(document).on('click', '#footer-main.collapsed .block-title', function (e) {
    $(this).parent().toggleClass('collapsed');
    $(this).parent().find('.block-content').toggleClass('collapse');
});
