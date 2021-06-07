/**
* 2007-2020 PrestaShop
*
* Godzilla Theme Setting
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/


jQuery(function ($) {
	$(document).on('click','#gdz-setting-tabs > .tab > a',function(e) {
			e.preventDefault();
			e.stopPropagation();
			let $submenu = $(this).parent();
			$('body').toggleClass('setting-sidebar-closed');
			let onlyClose = $(e.currentTarget).parent().hasClass('ul-open');
			$('#gdz-setting-tabs li.haschild a > i.material-icons.ps-togglable-row')
					.text('keyboard_arrow_down');
			if ($('body').is('.setting-sidebar-closed:not(.mobile)')) {
					$('#gdz-setting-tabs > .tab.ul-open').removeClass('ul-open open');
					$('#gdz-setting-tabs li.haschild.ul-open ul').removeAttr('style');
			} else {
					$('#gdz-setting-tabs li.haschild.ul-open ul').slideUp({
							complete: function() {
									$(this).parent().removeClass('ul-open open');
									$(this).removeAttr('style');
							}
					});
			}
			if (onlyClose) {
					return;
			}
			$submenu.addClass('ul-open');
			if ($('body').is('.setting-sidebar-closed:not(.mobile)')) {
					$submenu.addClass('open');
					$submenu.find('ul.haschild').removeAttr('style');
			} else {

					$submenu.find('ul').slideDown({
							complete: function() {
									$submenu.addClass('open');
									$(this).removeAttr('style');
							}
					});
			}
			$submenu.find('i.material-icons.ps-togglable-row').text('keyboard_arrow_up');
	});
	$(document).on('click','.image-option',function(event) {
      $(this).prev().prop('checked', true);
			console.log($(this).prev());
	});
	// field condition
	function ConditionCheck(leftValue, rightValue, operator) {
			switch (operator) {
					case '==':
							return leftValue == rightValue;
					case '!=':
							return leftValue != rightValue;
					case '<=':
							if (jQuery.inArray(leftValue, rightValue) == -1) {
									return false;
							} else {
									return true;
							}
					default:
							return leftValue === rightValue;
			}
	}
	$('#configuration_form').find('.condition-setting').each(function () {
			var $field = $(this);
			var condition = $(this).data('condition');
			console.log(condition);
			$.each(condition, function (input, value) {
					var parsedValue = value.match(/(\w+)(?:\[(\w+)])?/gi),
							conditionValue = undefined;
					var conditionOperator = value.match(/(\!=|<=|==)(?:\[(\w+)])?/gi)[0];
					var $checker = $('input[name=' + input + '], select[name=' + input + ']');
					var checkerVal = $checker.val();

					if ($checker.attr('type') == 'radio') {
							checkerVal = $('input[name=' + input + ']:checked').val();
					}

					if (parsedValue) {
							conditionValue = parsedValue[0];
					} else {
							conditionValue = '';
					}

					if (conditionOperator == '<=') {
							conditionValue = parsedValue;
					}
					alert
					if (ConditionCheck(checkerVal, conditionValue, conditionOperator)) {
							$field.addClass('show-setting');
					} else {
							$field.removeClass('show-setting');
					}
					$checker.on('change input', function () {
							if (ConditionCheck(this.value, conditionValue, conditionOperator)) {
									$field.addClass('show-setting');
							} else {
									$field.removeClass('show-setting');
							}
					});
			});
	});
	//filemanager iframe
	$('.js-dialog-upload').fancybox({
			'width': 900,
			'height': 600,
			'type': 'iframe',
			'autoScale': false,
			'autoDimensions': false,
			'fitToView': false,
			'autoSize': false,
			onUpdate: function onUpdate() {
					var $linkImage = $('.fancybox-iframe').contents().find('a.link');
					var inputName = $(this.element).data('input-name');
					$linkImage.data('field_id', inputName);
					$linkImage.attr('data-field_id', inputName);
			},
			afterShow: function afterShow() {
					var $linkImage = $('.fancybox-iframe').contents().find('a.link');
					var inputName = $(this.element).data('input-name');
					$linkImage.data('field_id', inputName);
					$linkImage.attr('data-field_id', inputName);
			},
			beforeClose: function beforeClose() {
					var $input = $('#' + $(this.element).data("input-name"));
					var val = $input.val();
					$input.val(val.replace($('#gdz-root-url').val(), ""));
					$input.change();
			}
	});

});
$(document).ready(function() {
	$("#page-header-desc-configuration-savesetting").click(function(d) {
			d.preventDefault();
			d.stopPropagation();
			var form = $('#configuration_form');
			form.action = $(this).attr('href');
			//form.submit();
			tinyMCE.triggerSave(true, true);
			$.ajax({
            type: 'post',
            url: $(this).attr('href'),
            data: form.serialize(),
            success: function () {
							$('#ajax_confirmation').html('Setting saved success!');
							$('#ajax_confirmation').removeClass('hide');
							setTimeout(function(){
								$('#ajax_confirmation').addClass('hide');
							}, 8000);
            }
          });
	});
	$("#page-header-desc-configuration-activekey").click(function(d) {
			d.preventDefault();
			d.stopPropagation();
			var form = $('#configuration_form');
			form.action = $(this).attr('href');
			$.ajax({
            type: 'post',
            url: $(this).attr('href'),
            data: form.serialize(),
            success: function (response) {
							if(response == 2) {
									$('#ajax_confirmation').removeClass('alert-success');
									$('#ajax_confirmation').addClass('alert-warning');
									$('#ajax_confirmation').html('License key active fail!');
							} else if(response == 3) {
									$('#ajax_confirmation').removeClass('alert-success');
									$('#ajax_confirmation').addClass('alert-danger');
									$('#ajax_confirmation').html('License key is invalid!');
							} else {
									var res_arr = JSON.parse(response);
									$.ajax({
										url: res_arr['client_url'] + '/modules/gdz_themesetting/ajax_run.php?action=gen_actived_file',
										method: 'GET',
										data:'domain=' + res_arr['domain'] + '&subscription=' + res_arr['subscription'],
										success: function (response) {
											$('#ajax_confirmation').removeClass('alert-danger alert-warning');
											$('#ajax_confirmation').addClass('alert-success');
											$('#ajax_confirmation').html('License actived success!');
										}
									});
							}
							$('#ajax_confirmation').removeClass('hide');
							setTimeout(function(){
								$('#ajax_confirmation').addClass('hide');
							}, 8000);
							document.location = $('#back_url').val();
            }
          });
	});
	$('.g-font-family').on('change', function() {
			var _this = this;
			var fontfamily = this.value;
			var ajaxurl = $('#gdz-base-url').val() + 'modules/gdz_themesetting/ajax_run.php?action=load_font_weight&fontfamily=' + fontfamily;
			$.ajax({
	      url: ajaxurl,
	      method: 'GET',
				dataType: 'json',
	    }).then(function (resp) {
				$(_this).next('.g-font-weight').find('option').remove().end();
				$.each(resp, function( index, value ) {
					$(_this).next('.g-font-weight').append(`<option value="${value}">${value}</option>`);
				});
				var css = `@import url('https://fonts.googleapis.com/css?family=${fontfamily}');`;
				$('<style/>').append(css).appendTo(document.head);
				$(_this).parent().find('.text-preview').css('font-family',fontfamily);
	    }).fail((resp) => {
	      alert('fail');
	    });
	});
	$('.g-font-family').each(function() {
			var _this = this;
			var fontfamily = this.value;
			var css = `@import url('https://fonts.googleapis.com/css?family=${fontfamily}');`;
			$('<style/>').append(css).appendTo(document.head);
			$(_this).parent().find('.text-preview').css('font-family',fontfamily);
	});
});
