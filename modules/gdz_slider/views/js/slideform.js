/**
* 2007-2020 PrestaShop
*
* Godzilla Slider
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/
$(document).ready(function () {
    if ($("#bg_type_on").prop("checked")) {
        $('.bg_img').show();
        $('.bg_color').hide();
    } else {
        $('.bg_img').hide();
        $('.bg_color').show();
    }
    $("#bg_type_on").click(function (e) {
        $('.bg_img').show();
        $('.bg_color').hide();
    });
    $("#bg_type_off").click(function (e) {
        $('.bg_img').hide();
        $('.bg_color').show();
    });
})
