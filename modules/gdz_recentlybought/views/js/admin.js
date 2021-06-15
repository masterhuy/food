/**
 * @package Godzilla Recently Bought
 * @version 1.0
 * @Copyright (C) 2009 - 2020 Godzilla.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @Website: https://www.godzillabuilder.com
**/

$(document).ready(function() {
    function jrbShowProductOption() {
        $('.product-select').removeClass('hide');
        $('.category-select, .order-select').addClass('hide');
    }
    function jrbShowCategoryOption() {
        $('.category-select').removeClass('hide');
        $('.product-select, .order-select').addClass('hide');
    }
    function jrbShowOrderOption() {
        $('.order-select').removeClass('hide');
        $('.product-select, .category-select').addClass('hide');
    }
    function hideOption() {
        $('.order-select, .category-select, .product-select').addClass('hide');
    }
    $(".chosen-select").chosen({width : "100%"});
    $("#GRB_GET_PRODUCT_TYPE").change(function() {
        console.log($(this).val());
        switch($(this).val()) {
            case '2':
                jrbShowOrderOption();
                break;
            case '4':
                jrbShowCategoryOption();
                break;
            case '3':
                jrbShowProductOption();
                break;
            default:
                hideOption();
                break;

        }
    })

});
