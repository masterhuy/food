{*
* 2007-2020 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2020 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<%
  component = $('#gdz-configuration').data('component');
  if(component) {
    setting = component.data('setting');
    console.log(setting);
    $.ajax({
      type: 'POST',
      url: PagebuilderConfig.editor_link + '&action=GetInstagram&ajax=1',
      data: {
          'setting' : setting,
      },
      success: function(data)
      {
        component.find('.addon-body').html(data);
        component.find('.pb-instagram').each(function() {
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
                  nav:parseInt($carousel.attr('data-nav')),
                  dots:parseInt($carousel.attr('data-dots')),
                  autoplay:parseInt($carousel.attr('data-auto')),
                  rewind:parseInt($carousel.attr('data-rewind')),
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
      }
    });
  }
%>
