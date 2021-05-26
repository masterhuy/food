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
function getParentByClassName(element, parent) {
    while (element.className.indexOf(parent)) {
        element = element.parentElement;
    }
    return element;
}
function openCity(element, cityName) {
    inner = getParentByClassName(element, 'inner');
    var i, tabcontent, tablinks;
    tabcontent = inner.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = inner.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    element.className += " active";
}
$(document).ready(function () {
    $('.defaultOpen').click();
})
