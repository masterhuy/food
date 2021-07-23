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

    //testimonial width thumbnails
    if($(".pb-testimonial").hasClass("with-thumbnails")){
        var bigimage = $(".pb-testimonial-carousel");
        var thumbs = $(".testimonial-thumbnail-carousel");
        var syncedSecondary = true;
        bigimage.addClass('owl-carousel');
        bigimage
        .owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: true,
        autoplay: false,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25 13.75H9.7875L16.775 6.7625L15 5L5 15L15 25L16.7625 23.2375L9.7875 16.25H25V13.75Z" fill="white" fill-opacity="0.3"/></svg>','<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 16.25H20.2125L13.225 23.2375L15 25L25 15L15 5L13.2375 6.7625L20.2125 13.75L5 13.75V16.25Z" fill="white" fill-opacity="0.3"/></svg>'],
        })
        .on("changed.owl.carousel", syncPosition);
        thumbs.addClass('owl-carousel');
        thumbs
        .on("initialized.owl.carousel", function() {
        thumbs
            .find(".owl-item")
            .eq(0)
            .addClass("current");
        })
        .owlCarousel({
        items: 3,
        margin: 25,
        dots: false,
        nav: false,
        navText: ['<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M25 13.75H9.7875L16.775 6.7625L15 5L5 15L15 25L16.7625 23.2375L9.7875 16.25H25V13.75Z" fill="white" fill-opacity="0.3"/></svg>','<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5 16.25H20.2125L13.225 23.2375L15 25L25 15L15 5L13.2375 6.7625L20.2125 13.75L5 13.75V16.25Z" fill="white" fill-opacity="0.3"/></svg>'],
        smartSpeed: 200,
        slideSpeed: 500,
        slideBy: 1,
        responsiveRefreshRate: 100
        })
        .on("changed.owl.carousel", syncPosition2);

        function syncPosition(el) {
            //if loop is set to false, then you have to uncomment the next line
            //var current = el.item.index;

            //to disable loop, comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            //to this
            thumbs
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = thumbs.find(".owl-item.active").length - 1;
            var start = thumbs
            .find(".owl-item.active")
            .first()
            .index();
            var end = thumbs
            .find(".owl-item.active")
            .last()
            .index();

            if (current > end) {
                thumbs.data("owl.carousel").to(current, 100, true);
            }
            if (current < start) {
                thumbs.data("owl.carousel").to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                bigimage.data("owl.carousel").to(number, 100, true);
            }
        }

        thumbs.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            bigimage.data("owl.carousel").to(number, 300, true);
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
    e.preventDefault();
    $('.switch-view').removeClass('active');
    $(this).addClass('active');
    if($(this).hasClass('view-grid')) {
        $('#product_list').removeClass('products-list');
        $('#product_list').addClass('products-grid');
    } else {
        $('#product_list').removeClass('products-grid');
        $('#product_list').removeClass('grid-2');
        $('#product_list').removeClass('grid-3');
        $('#product_list').removeClass('grid-4');
        $('#product_list').addClass('products-list');
    }
});
$(document).on('click', '.switch-view.grid-2', function (e) {
    $('#product_list').addClass('grid-2');
    $('#product_list').removeClass('grid-3');
    $('#product_list').removeClass('grid-4');
});
$(document).on('click', '.switch-view.grid-3', function (e) {
    $('#product_list').addClass('grid-3');
    $('#product_list').removeClass('grid-2');
    $('#product_list').removeClass('grid-4');
});
$(document).on('click', '.switch-view.grid-4', function (e) {
    $('#product_list').addClass('grid-4');
    $('#product_list').removeClass('grid-2');
    $('#product_list').removeClass('grid-3');
});

$(document).on('click', '.dropdown-menu', function (e) {
    e.stopPropagation();
});

jQuery(document).ready(function () {
    var menuItem = $('.gdz-megamenu .nav > .menu-item .mega-nav li');
        menuItem.each(function() {
        let dataGroup = $(this).attr('data-group');
        if(dataGroup == '0'){
            $(this).removeClass('group');
        }
    });
    $(".additional-links .link-comment").click(function() {
        $('#more_info_block .nav-tabs .reviews-link a').tab('show');
        $('#more_info_block #accordion .reviews-link a').collapse('show');
    });
    $('.block_newsletter .alert').fadeOut(5000);
    
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
    
    paginationToTop();
    prestashop.on('updateProductList', function () {
        paginationToTop();
    });

    changeIconNewsletter();

    itemShow();
    openFilterSidebar();
    closeFilterSidebar();
    prestashop.on("updateProductList",(function(){
        itemShow();
        openFilterSidebar();
        closeFilterSidebar();
    }));

    cloneQuantity();
    prestashop.on('updatedProduct', function () {
        cloneQuantity();
    });

    
});

jQuery(window).resize(function () {
    changeShopGrid();
    footerCollapse();
});

$(document).on('click', '#footer-main.collapsed .block-title', function (e) {
    $(this).parent().toggleClass('collapsed');
    $(this).parent().find('.block-content').toggleClass('collapse');
});

/* showing number of item in product top */
function itemShow(){
    let itemShowContent = $(".pagination-summary span").clone(true);
    $(".js-item-show").html(itemShowContent);
}

function cloneQuantity(){
    let qty = $("#product-details .product-quantities span").clone(true);
    $(".product-information .available-quantity span").html(qty);
    $(".product-information .available-quantity span + span").remove();
}

function changeIconNewsletter(){
    let btnSubmit = $(".widget-newsletter .block_newsletter button");
    let icon = $('<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM4 8L12 13L20 8V18H4V8ZM4 6L12 11L20 6H4Z" fill="#3F2803"/></svg>');
    btnSubmit.empty();
    btnSubmit.html(icon);
}

function paginationToTop(){
    var $paginationBtn = $('.js-search-link');
    $paginationBtn.on('click', function (e) {
        $('html, body').animate({
            'scrollTop': 0
        }, 0);
        e.preventDefault();
    });
}

function openFilterSidebar(){
	$('body').on('click', '#search_filter_toggler', function () {
		$("body").addClass("open-filter overflow-hidden");
	});
}

function closeFilterSidebar(){
	$('body').on('click', '.js-close-filter', function () {
		$("body").removeClass("open-filter overflow-hidden");
	});
	$(".main-site > .bg-overlay").click(function(){
		$("body").removeClass("open-filter overflow-hidden");
	});
}


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