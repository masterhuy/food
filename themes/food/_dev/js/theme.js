/**
 * 2007-2019 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
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
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2019 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */
import 'bootstrap/dist/js/bootstrap.min';
import 'flexibility';
import 'bootstrap-touchspin';

import './responsive';
import './checkout';
import './customer';
import './listing';
import './product';
import './cart';
import './off-canvas';

import Form from './components/form';
import ProductMinitature from './components/product-miniature';
import ProductSelect from './components/product-select';

import prestashop from 'prestashop';
import EventEmitter from 'events';

//import './lib/owl.carousel.min';
//import './lib/jquery.countdown.min';
import './lib/slick.min';
import './lib/jquery.elevatezoom';
import './lib/bootstrap-filestyle.min';

import './components/block-cart';
//import './custom';

// "inherit" EventEmitter
for (var i in EventEmitter.prototype) {
  prestashop[i] = EventEmitter.prototype[i];
}

$(document).ready(() => {
  const form = new Form();
  let productMinitature = new ProductMinitature();
  let productSelect  = new ProductSelect();
  form.init();
  productMinitature.init();
  productSelect.init();
  $("#products").bind("DOMSubtreeModified", function() {
    productMinitature.init();
  });
});
