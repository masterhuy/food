/**
* 2007-2019 PrestaShop
*
* Jms Page Builder
*
*  @author    Joommasters <joommasters@gmail.com>
*  @copyright 2007-2019 Joommasters
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: http://www.joommasters.com
*/

jQuery(function ($) {
    "use strict";
      	var bodyEl = $("body"),
      		content = $('.bg-overlay'),
      		togglebtn = $('#mobile-menu-toggle'),
      		closebtn = $('#mobile-menu-close' ),
      		isOpen = false;
	function init() {
		initEvents();
	}

	function initEvents() {
		togglebtn.click(function(e) {
			toggleMenu();
			e.stopPropagation();
		});
		if( closebtn ) {
			closebtn.click(function() {
				toggleMenu();
			});
		}
		content.click(function(e) {
			var target = e.target;
			if( isOpen && target !== togglebtn ) {
				toggleMenu();
			}
		});
	}
	function toggleMenu() {
		if( isOpen ) {
			bodyEl.removeClass('show-menu');
		}
		else {
			bodyEl.addClass('show-menu');
		}
		isOpen = !isOpen;
	}
	init();

});

jQuery(function ($) {
    "use strict";
    $("#off-canvas-menu .mega .caret").click(function (e) {
        e.preventDefault();
        var _parent = $(this).parent();
        var _dropdown = _parent.next('.dropdown-menu');
        var _grandparent = _parent.parent();
        if(_grandparent.hasClass('open')) {
            _grandparent.removeClass('open');
            _dropdown.slideUp("normal");
            $(this).removeClass('rotate');
        } else {
            _grandparent.addClass('open');
            _dropdown.slideDown("normal");
            $(this).addClass('rotate');
        }
    })
    $(".mega .caret").mouseover(function (e) {
        e.preventDefault();
        return false;
    })
    $("#off-canvas-menu li a").mouseover(function (e) {
        e.preventDefault();
        return false;

    })
});
