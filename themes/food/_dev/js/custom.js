jQuery(function ($) {
    "use strict";
    //header sticky
    var win = $(window),
      header = $('.header-sticky');
    if(header.length > 0) {
        var offset = (header.offset().top);
        win.scroll(function() {
          if (offset < win.scrollTop()) {
            header.addClass("sticky");
          } else {
            header.removeClass("sticky");
          }
        });
    }
    //search
    $( ".btn-search-full" ).click(function() {
        $('#search-form-full').toggleClass('open');
    });
    $( ".search-box-close" ).click(function() {
        $('#search-form-full').removeClass('open');
    });
    //sidebar
    $( "#sidebar-btn" ).click(function() {
        if($('#header-sidebar').hasClass('right-sidebar'))
          $('body').toggleClass('sidebar-right-open');
        else
          $('body').toggleClass('sidebar-left-open');
    });
    $(document).on('click', function(){
        if($('body').hasClass('sidebar-right-open'))
            $('body').removeClass('sidebar-right-open');
        if($('body').hasClass('sidebar-left-open'))
            $('body').removeClass('sidebar-left-open');
    });
    $('#header-sidebar, #sidebar-btn').on('click', function(e){
        e.stopPropagation();
    });

    //carousel
    var c_lazyload = false;
    if(gdzSetting.carousel_lazyload)
      var c_lazyload = true;
    $.each( $(".owl-carousel"), function( key, value ) {
          $(this).owlCarousel({
              loop:true,
              margin:30,
              nav:$(this).data('nav'),
              dots:$(this).data('dots'),
              autoplay:$(this).data('auto'),
              rewind:$(this).data('rewind'),
              slideBy:$(this).data('slidebypage'),
              lazyLoad:c_lazyload,
              responsive:{
                0:{
                    items:$(this).data('xs')
                },
                768:{
                    items:$(this).data('sm')
                },
                991:{
                    items:$(this).data('md')
                },
                1199:{
                    items:$(this).data('lg')
                },
                1440:{
                    items:$(this).data('items')
                }
            }
          });
    });
    //product image zoom
    $('.product-image-zoom').elevateZoom({
        zoomType: "inner",
        cursor: "crosshair",
        zoomWindowFadeIn: 500,
        zoomWindowFadeOut: 750
    });
    //countdown
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

$(document).mouseup(function(e){
    var container = $('.search-box');
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        container.closest('.search-overlay').removeClass('open');
    }
});

$(document).on('click', '.switch-view', function (e) {
  $('.switch-view').removeClass('active');
  $(this).addClass('active');
  if($(this).hasClass('view-grid')) {
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
    if (jQuery(window).width() < 576) {
        $('.products-grid').removeClass('grid-1 grid-2 grid-3 grid-4 grid-5 grid-6');
        $('.products-grid').addClass('grid-1');
    } else if(jQuery(window).width() < 768) {
        $('.products-grid').removeClass('grid-1 grid-2 grid-3 grid-4  grid-5 grid-6');
        $('.products-grid').addClass('grid-2');
    } else if(jQuery(window).width() < 992) {
        $('.products-grid').removeClass('grid-1 grid-2 grid-3 grid-4 grid-5 grid-6');
        $('.products-grid').addClass('grid-3');
    } else {
        $('.products-grid').removeClass('grid-1 grid-2 grid-3 grid-4 grid-5 grid-6');
        $('.products-grid').addClass('grid-' + shop_grid_column);
    }
}
function footerCollapse() {
  if ((jQuery(window).width() < 480) && gdzSetting.footer_block_collapse) {
      $('#footer-main').addClass('collapsed');
      $('#footer-main').find('.block-content').addClass('collapse');
  } else {
    $('#footer-main').removeClass('collapsed');
    $('#footer-main').find('.block-content').removeClass('collapse');
  }
}
jQuery(document).ready(function(){
    $('.gdz-megamenu').jmsMegaMenu({
      event: 'hover',
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
