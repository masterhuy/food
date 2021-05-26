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
  if ($(".gdz-megamenu").length > 0){
    $('.gdz-megamenu').jmsMegaMenu({
      event: 'hover',
      duration: 100,
    });
  }  
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
