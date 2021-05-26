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
    $.ajax({
        type: 'POST',
        url: PagebuilderConfig.editor_link + '&action=GetSlider&ajax=1',
        data: {
            'setting' : setting,
        },
        success: function(data)
        {
                component.find('.addon-body').html(data);
                slider = component.find('.slider');
                slider.fractionSlider({
                    'slideTransition' : slider.attr('data-slideTransition'),
                    'slideEndAnimation' : (slider.attr('data-slideEndAnimation') == "1")?true:false,
                    'transitionIn' : slider.attr('data-transitionIn'),
                    'transitionOut' : slider.attr('data-transitionOut'),
                    'fullWidth' : (slider.attr('data-fullWidth') == "1")?true:false,
                    'delay' : slider.attr('data-delay'),
                    'timeout' : slider.attr('data-timeout'),
                    'speedIn' : slider.attr('data-speedIn'),
                    'speedOut' : slider.attr('data-speedOut'),
                    'easeIn' : slider.attr('data-easeIn'),
                    'easeOut' : slider.attr('data-easeOut'),
                    'controls' : (slider.attr('data-controls') == "1")?true:false,
                    'pager' : (slider.attr('data-pager') == "1")?true:false,
                    'autoChange' : (slider.attr('data-autoChange') == "1")?true:false,
                    'pauseOnHover' : (slider.attr('data-pauseOnHover') == "1")?true:false,
                    'backgroundAnimation' : (slider.attr('data-backgroundAnimation') == "1")?true:false,
                    'backgroundEase' : slider.attr('data-backgroundEase'),
                    'responsive' : (slider.attr('data-responsive') == "1")?true:false,
                    'dimensions' : slider.attr('data-dimensions'),
                    'mobile_height' : slider.attr('data-mobile_height'),
                    'mobile2_height' : slider.attr('data-mobile2_height'),
                    'tablet_height' : slider.attr('data-tablet_height'),
                })
        }
  });
}
%>
