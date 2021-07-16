/* global $, prestashop */

/**
 * This module exposes an extension point in the form of the `showModal` function.
 *
 * If you want to override the way the modal window is displayed, simply define:
 *
 * prestashop.blockcart = prestashop.blockcart || {};
 * prestashop.blockcart.showModal = function myOwnShowModal (modalHTML) {
 *   // your own code
 *   // please not that it is your responsibility to handle closing the modal too
 * };
 *
 * Attention: your "override" JS needs to be included **before** this file.
 * The safest way to do so is to place your "override" inside the theme's main JS file.
 *
 */

$('body').on('click', '.ajax-add-to-cart', function (event) {
  event.preventDefault();
  var query =
    'id_product=' +
    $(this).attr('data-id-product') +
    '&qty=' +
    $(this).attr('data-minimal-quantity') +
    '&token=' +
    $(this).attr('data-token') +
    '&add=1&action=update';
  var actionURL = prestashop['urls']['base_url'] + 'index.php?controller=cart';
  $(this).removeClass('checked');
	$(this).addClass('checking');
  var callerElement = $(this);
  if ($('#cart_block').hasClass('no-ajax')) document.location = actionURL;
  $.post(actionURL, query, null, 'json')
    .then(function (resp) {
      prestashop.emit('updateCart', {
        reason: {
          idProduct: resp.id_product,
          idProductAttribute: resp.id_product_attribute,
          linkAction: 'add-to-cart',
        },
      });
      $(callerElement).removeClass('checking');
      $(callerElement).addClass('checked');
      $(".quickview-modal").modal('hide');
      window.setTimeout( function() {$(callerElement).removeClass('checked');}, 3000 );
    })
    .fail(function (resp) {
      prestashop.emit('handleError', {
        eventType: 'addProductToCart',
        resp: resp,
      });
    });
});

$('body').on('click', '[data-button-action="add-to-cart"]', function (event) {
  $(this).removeClass('addtocart-selected');
  $(this).addClass('addtocart-selected');
  $(this).removeClass('checked');
  $(this).addClass('checking');
});

$(document).ready(function () {
  prestashop.blockcart = prestashop.blockcart || {};

  var showModal =
    prestashop.blockcart.showModal ||
    function (modal) {
      var $body = $('body');
      $body.append(modal);
      $body.one('click', '#blockcart-modal', function (event) {
        if (event.target.id === 'blockcart-modal') {
          $(event.target).remove();
        }
      });
    };

  $(document).ready(function () {
    prestashop.on('updateCart', function (event) {
      var refreshURL = $('.blockcart').data('refresh-url');
      var requestData = {};

      if (event && event.reason) {
        requestData = {
          id_product_attribute: event.reason.idProductAttribute,
          id_product: event.reason.idProduct,
          action: event.reason.linkAction,
        };
      }
      $.post(refreshURL, requestData)
      
        .then(function (resp) {
          $('.blockcart').replaceWith(resp.preview);
          if (resp.modal && $('#cart_block').hasClass('popup')) {
            showModal(resp.modal);
          } else if ($('#cart_block').hasClass('cartbox-open')) {
            $('#cart_block').addClass('open');
            setTimeout(function () {
              $('#cart_block').removeClass('open');
            }, 5000);
          } else if ($('#cart_block').hasClass('number-bounce')) {
            $('#cart_block').addClass('bounce');
            setTimeout(function () {
              $('#cart_block').removeClass('bounce');
            }, 3000);
          } else if ($('#cart_block').hasClass('circle-filled')) {
            $('#cart_block').addClass('bounce');
            setTimeout(function () {
              $('#cart_block').removeClass('bounce');
            }, 3000);
          }
          var callerElement = $('.add-to-cart');
          $(callerElement).removeClass('checking');
          $(callerElement).addClass('checked');
          window.setTimeout( function() {$(callerElement).removeClass('checked');}, 2000 );
        })
        .fail(function (resp) {
          prestashop.emit('handleError', {
            eventType: 'updateShoppingCart',
            resp: resp,
          });
        });
    });
  });
});
