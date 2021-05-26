/**
* 2007-2020 PrestaShop
*
Godzilla PageBuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

function genID() {
    return Math.floor(Math.random() * 1e8);
}
function validateStr(string) {
    return string.replace(/"/g, "_GDZQUOTE_").replace(/'/g, "_GDZQUOTE2_").replace(/\\/g, "_GDZSLASH_").replace(/&amp;/g, "&").replace(/&lt;/g, "<").replace(/&gt;/g, ">").replace(/\//g, "\/").replace(/[\n]/g, '_GDZLB_').replace(/[\r]/g, '_GDZRN_').replace(/[\t]/g, '_GDZTAB_');
}
function UiTooltip() {
	$('.label-tooltip').tooltip();
}
function UiSort() {
	var $_rows = $(".rowlist");
	$_rows.sortable({
		opacity: 0.6,
		cursor: "move"
	});
	var $_columns = $(".row-columns");
	$_columns.sortable({
		opacity: 0.6,
		cursor: "move"
	});
	var $_addonboxs = $(".column");
	$_addonboxs.sortable({
		connectWith: '.column',
		opacity: 0.6,
		cursor: "move"
	});
}
function loadFancyBox() {
  $(document).on('click','.media-upload',function(event) {
      $.fancybox({
          type: 'iframe',
          href: $(this).attr('data-url'),
          autoDimensions: false,
          autoSize: false,
          arrows : false,
          width: 600,
          height: 500,
          helpers: {
            overlay: {
              locked: false
            }
          }
      });
  });
}
//Drag & Drop Init Function
function dragDropInit() {
    var dragged;
    $(".addon-cat-addons").on('dragstart',function(event) {
        dragged = event.target;
    });
    $(document).find('.column').on('dragenter',function(event)
    {
        event.preventDefault();
        event.stopPropagation();
        $(document).find('.layout-column').removeClass('column-active');
        $(this).parent().addClass('column-active');
        //$(document).find('.ui-state-highlight').remove();
        if($(dragged).hasClass('addon-cat-addons') && !$(dragged).hasClass('pro')) {
            $(document).find('.ui-state-highlight').remove();
            if(!$(event.target).hasClass('layout-column')) {
                if($(event.target).closest('.addon-box').length > 0) {
                  var _target = $(event.target).closest('.addon-box');
                  $("<div class='ui-state-highlight'></div>").insertAfter(_target);
                } else {
                  var _target = $(event.target).closest('.column');
                  $(event.target).closest('.column').append("<div class='ui-state-highlight'></div>");
                }
            } else {
                $(event.target).append("<div class='ui-state-highlight'></div>");
            }
        }
    }).on('dragover',function(event)
    {
        event.preventDefault();
        event.stopPropagation();
    });
    $(document).find('.column').on('drop',function(event) {
        event.preventDefault();
        event.stopPropagation();
        if($(dragged).hasClass('addon-cat-addons') && !$(dragged).hasClass('pro')) {
            $(dragged).find('.addon-box').elementEdit();
            dragged = null;
        }
    });
}
function loadSettings() {
    if(pageJson == '') return;
    var pagesettings = JSON.parse(pageJson);
    var rows = $('.rowlist').find('.row');
		rows.removeClass('row-active');
    rows.each(function(index){
        var $row 		= $(this);
        $row.data('settings', pagesettings[index]['settings']);
        var columns = $row.find('.layout-column');
        columns.removeClass('column-active');
  			columns.each(function(cindex) {
  			    var $column 	= $(this);
            $column.data('settings', pagesettings[index]['cols'][cindex]['settings']);
        });
    });
}
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
function reLoadUI() {
    $(document).find('.pagebuilder-checkbox').on('click',function(event) {
      var _cb = $(this).find('.gdz-switch');
      if(_cb.is(':checked'))
        _cb.prop('checked', false);
      else
        _cb.prop('checked', true);
      _cb.trigger('change');
    });
    loadFancyBox();
    $('.items-container').sortable({
        placeholder: "ui-state-highlight",
        connectWith: ".items-container"
    });
    $('.color-picker-component').colorpicker();
    $('.gdz-modal-body').find('.condition-setting').each(function () {
        var $field = $(this);
        var condition = JSON.parse($(this).attr('data-condition'));
        $.each(condition, function (input, value) {
            var parsedValue = value.match(/(\w+)(?:\[(\w+)])?/gi),
                conditionValue = undefined;
            var conditionOperator = value.match(/(\!=|<=|==)(?:\[(\w+)])?/gi)[0];

            var $checker = $('.gdz-modal-body').find('input[name=' + input + '], select[name=' + input + ']');

            var checkerVal = $checker.val();
            if ($checker.attr('type') == 'radio') {
                checkerVal = $('input[name=' + input + ']:checked').val();
            }
            if ($checker.attr('type') == 'select') {
                checkerVal = $('input[name=' + input + ']:selected').val();
            }
            if($checker.attr('data-type') == 'checkbox2') {
                if($('input[name=' + input + ']').is(":checked"))
                  checkerVal = 1;
                else
                  checkerVal = 0;
            }
            if (parsedValue) {
                conditionValue = parsedValue[0];
            } else {
                conditionValue = '';
            }

            if (conditionOperator == '<=') {
                conditionValue = parsedValue;
            }
            if (ConditionCheck(checkerVal, conditionValue, conditionOperator)) {

                $field.addClass('show-setting');
            } else {
                $field.removeClass('show-setting');
            }
            $checker.on('change input', function () {
                if($(this).attr('data-type') == 'checkbox2') {
                    if($(this).is(":checked"))
                      var this_val = 1;
                    else
                      var this_val = 0;
                } else {
                  var this_val = this.value;
                }
                if (ConditionCheck(this_val, conditionValue, conditionOperator)) {
                    $field.addClass('show-setting');
                } else {
                    $field.removeClass('show-setting');
                }
            });
        });
    });
    if($('.gdz-modal-body').find('.group-tab').length == 0) {
        var addonname = $('.gdz-modal-body').find('.addon-box').attr('data-addon');
        var addon_input = JSON.parse(addonDefaults)[addonname];
        for(i=0; i < addon_input.length; i++) {
            if(addon_input[i]['type'] == 'tab') {
                var tab_class = "group-tab";
                if(addon_input[i]['open'] == 1) tab_class += ' tab-open';
                var tab_group = '<div class="form-group ' + tab_class + '"><label>' + addon_input[i]['label'] + '</label></div>';
                $(tab_group).insertBefore($('.gdz-modal-body').find('.item-inner > .form-group').eq(i));
            }
        }
    }
    var form_group = $('.gdz-modal-body').find('.item-inner > .form-group');
    var under_tab = false;
    var tab_open = false;
    form_group.each(function () {
        if($(this).hasClass('group-tab')) {
            under_tab = true;
            if($(this).hasClass('tab-open')) {
              tab_open = true;
            } else {
              tab_open = false;
            }
        }
        if(under_tab && !$(this).hasClass('group-tab')) $(this).addClass('under-tab');
        if(under_tab && tab_open && !$(this).hasClass('group-tab')) $(this).addClass('field-open');
    });
    form_group.on('click',function(event) {
        if($(this).hasClass('group-tab')) {
            var tab_start = form_group.index(this);
            var tab_end = form_group.length;
            for(i=tab_start+1; i < form_group.length; i++) {
                if(form_group.eq(i).hasClass('group-tab'))
                    tab_end = i;
            }
            if($(this).hasClass('tab-open')) {
              $(this).removeClass('tab-open');
              for(i=tab_start; i < tab_end; i++) {
                  form_group.eq(i).removeClass('field-open');
              }
            } else {
              $(this).addClass('tab-open');
              for(i=tab_start; i < tab_end; i++) {
                  form_group.eq(i).addClass('field-open');
              }
            }
        }
    });
    var icons = JSON.parse(awesomeIcons);
    $('.gdz-modal-body').find('input[name=icon_class]').autocomplete({
      source: icons
    });
    $('.gdz-modal-body').find('input[name=icon_class]').autocomplete( "option", "appendTo", ".eventInsForm" );
    $('.gdz-modal-body').find('.tree-selected').find('input[type=radio]').each(function () {
        $(this).prop('checked', true);
    });
}
function getLayout(){
		var config = [];
		var rows = $('.rowlist').find('.row');
		rows.removeClass('row-active');
		rows.each(function(index){
			var $row 		= $(this),
				rowIndex 	= index,
				rowsettings 		= $row.data('settings');
			var layout = 12;
			layout 	= $row.data('layout');
			config[rowIndex] = {
				'type'  	: 'row',
        'id'      : $row.attr('id'),
				'name'		: $row.data('name'),
				'layout'	: layout,
				'settings' 	: rowsettings,
				'cols'		: []
			};
			// Find Column Elements
			var columns = $row.find('.layout-column');
			columns.removeClass('column-active');
			columns.each(function(cindex) {
				var $column 	= $(this),
					colIndex 	= cindex,
					colsettings 		= $column.data('settings');
				config[rowIndex].cols[colIndex] = {
					'type' 				: 'column',
          'id'          : $column.attr('id'),
					'settings' 		: colsettings,
					'addons'		   : []
				};
				// Find Addon Elements
				var addons = $column.find('.addon-box');
				addons.removeClass('addon-active');
				addons.each(function(aindex) {
					var $addon 	= $(this),
					addonIndex 	= aindex,
					addonObj 		= $addon.data();
					delete addonObj.sortableItem;
					config[rowIndex].cols[colIndex].addons[addonIndex] = {
						'type' 				: $addon.data('addon'),
            'id'          : $addon.attr('id'),
						'settings' 		: addonObj,
						'fields'			: []
					};
					var addoninputs = $addon.find('.item-inner > .form-group .addon-input');
					addoninputs.each(function(aiindex) {
						var $input 	= $(this),
						addoninputIndex 	= aiindex;
						if($input.hasClass('addon-categories')) {
							var categories = $input.find('input[type=checkbox], input[type=radio]');
							var categories_result = new Array();

							categories.each(function(catindex) {
								if ($(this).is(":checked")) {
									categories_result.push($(this).val());
								}
							});
							var val_result = categories_result.join();
              var field_label = $input.closest('.form-group').find('label').html();
							config[rowIndex].cols[colIndex].addons[addonIndex].fields[addoninputIndex] = {
								'type'  : $input.data('type'),
								'label' : field_label,
								'name'	: $input.data('attrname'),
								'multilang' : $input.data('multilang'),
								'value'	: val_result
							};
						} else {
							var langfields = $input.find('.translatable-field .lang-input');
							if(langfields.length > 0) {
								var val_result = new Array()
								var obj = new Object();
								langfields.each(function(liindex) {
									var $langinput 	= $(this);
									var lang = $langinput.data('lang');
									var content = validateStr($langinput.getInputValue());
									obj[lang] = content;
								});
								val_result = obj;
							} else {
								var val_result = $input.getInputValue();
                if($input.attr('type') != 'images' && $input.attr('type') != 'accordion' && $input.attr('type') != 'testimonial' && $input.attr('type') != 'social')
								    val_result = validateStr(val_result);
							}
              var field_label = $input.closest('.form-group').find('label').html();
							config[rowIndex].cols[colIndex].addons[addonIndex].fields[addoninputIndex] = {
								'type'  : $input.data('type'),
								'label' : field_label,
								'name'	: $input.data('attrname'),
								'multilang' : $input.data('multilang'),
								'value'	: val_result
							};
						}

					});
				});
			});
		});
		return config;
}

jQuery(function ($) {
  loadSettings();
    // tinyMCE editor source code edit
	$(document).on('focusin', function(e) {
		if ($(e.target).closest(".mce-window").length) {
			e.stopImmediatePropagation();
		}
	});
	//Override clone
	(function (original) {
		jQuery.fn.clone = function () {
			var result       = original.apply(this, arguments),
			my_textareas     = this.find('textarea').add(this.filter('textarea')),
			result_textareas = result.find('textarea').add(result.filter('textarea')),
			my_selects       = this.find('select').add(this.filter('select')),
			result_selects   = result.find('select').add(result.filter('select'));

			for (var i = 0, l = my_textareas.length; i < l; ++i)
				$(result_textareas[i]).val($(my_textareas[i]).val());
			for (var i = 0, l = my_selects.length;   i < l; ++i)
				result_selects[i].selectedIndex = my_selects[i].selectedIndex;

			return result;
		};
	})($.fn.clone);

  "use strict";
	UiSort();
  dragDropInit();
  $(document).find('.pagebuilder-checkbox').on('click',function(event) {

    var _cb = $(this).find('.gdz-switch');
    if(_cb.is(':checked')) {
      _cb.prop('checked', true);
    } else {
      _cb.prop('checked', false);
    }
    _cb.trigger('change');
  });
  $(".gdz-switch").each(function(){
    $(this).parent().append('<label for="field_use_link"><span><span></span><strong class="pagebuilder-checkbox-1">YES</strong><strong class="pagebuilder-checkbox-2">NO</strong></span></label>');
    $(this).parent().trigger('click');
  });
  $(document).on('click', '.dropbtn', function(event){
      event.preventDefault();
      event.stopPropagation();
      if($(this).parent().hasClass('show')) {
        $('.dropdown').removeClass('show');
      } else {
        $('.dropdown').removeClass('show');
        $(this).parent().addClass('show');
      }
  });
	$(document).on('click','.column-layout',function(event) {
		event.preventDefault();
		layouttype = $(this).data('layout');
		if (layouttype == 'custom') {
			column = prompt('Enter your custom layout like 2,2,2,2,2,2 as total 12 grid','2,2,2,2,2,2');
		}
		$('.column-list li').removeClass('layout-active');
		$(this).parent().addClass('layout-active');
		$('.row').removeClass('row-active');
		if (layouttype == 'custom') {
			var layout_str = column;
		} else {
			var layout_str = $(this).data('layout');
		}
		var row_box = $(this).closest('.row');
		row_box.addClass('row-active');
		row_columns = row_box.find('.row-columns');
		row_box.attr('data-layout', layout_str) ;
		var old_columns = $(row_box).find('.layout-column');
		if(layout_str == '12')
			var new_columns = ['12'];
		else
			var new_columns = layout_str.split(',');
		var n_old_columns = old_columns.length;
		var n_new_columns = new_columns.length;

    var old_settings = [];
    $.each(old_columns, function(index, value){
      old_settings[index] = old_columns.eq(index).data('settings');
    });
    row_columns.empty();
		$.each(new_columns, function(index, value){
			if(index < n_old_columns) {
  			var old_column_id = old_columns.eq(index).attr('id');
				var html = '<div class="column">' + old_columns.eq(index).find('.column').html() + '</div><div class="col-tools"><a href="#" class="column-setting pull-right label-tooltip" data-original-title="Column Setting"><i class="icon-cog"></i><span>Setting</span></a></div>';
        var old_setting = old_settings[index];
        c = document.createElement('div');
        $(c).attr('id', old_column_id);
        $(c).addClass('layout-column col-lg-' + value);
        $(c).html(html);
        old_setting['lg_col'] = 'col-lg-' + value;
        $(c).data('settings', old_setting);
			} else {
        c = document.createElement('div');
        $(c).attr('id', `column-${genID()}`);
        $(c).addClass('layout-column col-lg-' + value);
				var html = '<div class="column"></div><div class="col-tools"><a href="#" class="column-setting pull-right label-tooltip" data-original-title="Column Setting"><i class="icon-cog"></i><span>Setting</span></a></div>';
        $(c).html(html);
        var settings = JSON.parse(columnSettingsDefault);
        settings['lg_col'] = 'col-lg-' + value;
        $(c).data('settings', settings);
      }
      $(c).appendTo(row_columns);

		});
		if(n_old_columns > n_new_columns)
			for(i = n_new_columns; i < n_old_columns; i++)
				row_columns.find('.column').eq(n_new_columns-1).append(old_columns.eq(i).find('.column').html());

		UiSort();
		UiTooltip();
    dragDropInit();
	});
  $(document).on('click','#add-row',function(event) {
  		event.preventDefault();
  		var $rowClone = $('#gdz_pagebuilder-row .row').clone(true);
      $($rowClone).attr("id", `row-${genID()}`);
  		$('.rowlist').append($rowClone);
  		UiTooltip();
      loadFancyBox();
      $($rowClone).data('settings', JSON.parse(rowSettingsDefault));
	});
	$.fn.setInputValue = function(options){
    if (this.attr('type') == 'images') {
        images_input = this;
        container = images_input.find('.items-container');
        options.filed.forEach(function(input) {
          fid = genID();
          form_group = images_input.find('.form-group.hidden').clone().removeClass('hidden');
          form_group.find('input[name=alt]').val(input.alt);
          form_group.find('input[name=link]').val(input.link);
          form_group.find('.media-image-preview').attr('id', 'media-preview-'+fid).css('background-image','url(' + input.image + ')');
          form_group.find('.media-value').attr('id', 'media-value-'+fid).val(input.image);
          form_group.find('.item-row-title').html(input.alt);
          select = form_group.find('.media-upload');
          select.attr('data-url', select.attr('data-url')+'&fid='+fid);
          if(!input.image) select.addClass('media-empty');
          container.append(form_group);
        })
    } else if (this.attr('type') == 'accordion') {
        accordion_input = this;
        container = accordion_input.find('.items-container');
        options.filed.forEach(function(input) {
          fid = genID();
          form_group = accordion_input.find('.form-group.hidden').clone().removeClass('hidden');
          form_group.find('input[name=title]').val(input.title);
          form_group.find('input[name=content]').val(input.content);
          form_group.find('.item-row-title').html(input.title);
          container.append(form_group);
        })
    } else if (this.attr('type') == 'social') {
        social_input = this;
        container = social_input.find('.items-container');
        options.filed.forEach(function(input) {
          fid = genID();
          form_group = social_input.find('.form-group.hidden').clone().removeClass('hidden');
          form_group.find('input[name=icon_class]').val(input.icon_class);
          form_group.find('input[name=link]').val(input.link);
          form_group.find('.item-row-title').html(input.icon_class);
          container.append(form_group);
        })
    } else if (this.attr('type') == 'testimonial') {
            repeat_input = this;
            container = repeat_input.find('.items-container');
            options.filed.forEach(function(input) {
              fid = genID();
              form_group = repeat_input.find('.form-group.hidden').clone().removeClass('hidden');
              form_group.find('input[name=image]').val(input.image);
              form_group.find('input[name=author]').val(input.author);
              form_group.find('input[name=position]').val(input.position);
              form_group.find('input[name=rating]').val(input.rating);
              form_group.find('[name=comment]').val(input.comment);
              form_group.find('.media-image-preview').attr('id', 'media-preview-'+fid).css('background-image','url(' + input.image + ')');
              form_group.find('.media-value').attr('id', 'media-value-'+fid).val(input.image);
              form_group.find('.item-row-title').html(input.alt);
              select = form_group.find('.media-upload');
              select.attr('data-url', select.attr('data-url')+'&fid='+fid);
              if(!input.image) select.addClass('media-empty');
              container.append(form_group);
            })
    } else if (this.attr('type') == 'checkbox') {
			if (options.filed == '1') {
				this.attr('checked','checked');
			} else {
				this.removeAttr('checked');
			}
		} else if(this.hasClass('input-media')){
      $imgParent = this.parent();
      if(options.filed) {
        $imgParent.find('.media-image-preview').css('background-image','url(' + root_url + options.filed + ')');
        this.val( options.filed );
      } else {
        $imgParent.find('.media-upload').addClass('media-empty');
      }
		} else {
			this.val( options.filed );
		}

		if (this.data('attrname') == 'column_type'){
			if (this.val() == 'component') {
				$('.form-group.name').hide();
			}
		}
	}

	$.fn.getInputValue = function(){
    if (this.attr('type') == 'images') {
      return this.find('.items-container').find('.form-group').map(function(i, e) {
        return {
          alt: $(e).find('input[name=alt]').val(),
          link: $(e).find('input[name=link]').val(),
          image: $(e).find('input[name=image]').val(),
        };
      }).get();
    } else if (this.attr('type') == 'accordion') {
      return this.find('.items-container').find('.form-group').map(function(i, e) {
        return {
          title: $(e).find('input[name=title]').val(),
          content: $(e).find('[name=content]').val(),
        };
      }).get();
    } else if (this.attr('type') == 'social') {
      return this.find('.items-container').find('.form-group').map(function(i, e) {
        return {
          icon_class: $(e).find('input[name=icon_class]').val(),
          link: $(e).find('[name=link]').val(),
        };
      }).get();
    } else if (this.attr('type') == 'testimonial') {
      return this.find('.items-container').find('.form-group').map(function(i, e) {
        return {
          image: $(e).find('input[name=image]').val(),
          author: $(e).find('input[name=author]').val(),
          position: $(e).find('input[name=position]').val(),
          rating: $(e).find('input[name=rating]').val(),
          comment: $(e).find('[name=comment]').val(),
        };
      }).get();
    } else if (this.attr('type') == 'checkbox') {
      if (this.is(":checked")) {
				return '1';
			}else{
				return '0';
			}
		}else {
			return this.val();
		}
	}

	function random_number() {
		return randomFromInterval(1, 1e6)
	}
	function randomFromInterval(e, t) {
		return Math.floor(Math.random() * (t - e + 1) + e)
	}
	$.fn.randomIds = function()
	{
		//Editor
		$(this).find('.gdz-editor').each(function(){
			var $id = random_number();
			$(this).attr('id', 'gdz-editor-' + $id);
		});
		$(this).find('.input-media').each(function(){
			var $id = random_number();
			$(this).attr('id', 'media-value-' + $id);
			$(this).next().attr('id', 'media-preview-' + $id);
      $(this).parent().find('.media-image-preview').attr('id', 'media-preview-'+$id);
      $(this).parent().find('.media-image-preview').css('background-image','url(' + $(this).val() + ')');
      select = $(this).parent().parent().find('.media-upload');
      select.attr('data-url', select.attr('data-url')+'&fid='+$id);
		});

	}
	//remove ids
	$.fn.cleanRandomIds = function(){

		$(this).find('select').chosen('destroy');
		//Editor
		$(this).find('.gdz-editor').each(function(){
			var $id = $(this).attr('id');
			tinyMCE.execCommand('mceRemoveEditor', false, $id);
			$(this).removeAttr('id').removeAttr('style').removeAttr('area-hidden');
		});

		$(this).find('.mce-tinymce').remove();

		return $(this);

	}
	//elementEdit
	$.fn.elementEdit = function(){
		$('#modal-addons').modal('hide');
		$('#addon-modal').find('.gdz-modal-body').empty();
		var $clone 	= $(this).clone();
		$clone 		= $clone.appendTo($('#addon-modal').find('.gdz-modal-body'));
		//Modal Title
		$('#addon-modal').find('.gdz-modal-title').text( $clone.find('span:first').text() );
    $('#addon-modal #save-addons').data('flag', 'add-addon');
		$clone.find('select').chosen({allow_single_deselect:true});
		$clone.randomIds();
		$('#addon-modal').modal('show');
    reLoadUI();
		$('#addon-modal').find('.gdz-editor').each(function(){
			var $id = $(this).attr('id');
			tinyMCE.execCommand('mceAddEditor', false, $id);
		});
	}

  $(document).on('click', '.dropbtn', function(event){
      if($(this).parent().hasClass('open')) {
        $('.dropup').removeClass('open');
      } else {
        $('.dropup').removeClass('open');
        $(this).parent().addClass('open');
      }

  });
  $(document).on('click', '.layout-column', function(event){
      $('.layout-column').removeClass('column-active');
      $(this).addClass('column-active');
  });
	$(document).on('click','.row-setting',function(event) {
		event.preventDefault();
		$('.row').removeClass('row-active');
		var $parent = $(this).closest('.row');
		$parent.addClass('row-active');
		$('#layout-modal').find('.gdz-modal-body').empty();
		$('#layout-modal .gdz-modal-title').text('Row Settings');
		$('#layout-modal #save-settings').data('flag', 'row-setting');
		var $clone = $('.row-settings').clone(true);
		$clone.randomIds();
		$clone = $('#layout-modal').find('.gdz-modal-body').append( $clone );
    var row_setting = $parent.data('settings');
		$clone.find('.addon-input').each(function(){
      var $that = $(this);
      var attrname = $that.attr('data-attrname');
      $that.setInputValue({filed: row_setting[attrname]});
		});
		$('#layout-modal').modal();
    $clone.find('.color-picker-component').colorpicker();
    loadFancyBox();
	});

	$(document).on('click','.column-setting',function(event) {
		event.preventDefault();
		$('.layout-column').removeClass('column-active');
		var $parent = $(this).closest('.layout-column');
		$parent.addClass('column-active');
		$('#layout-modal').find('.gdz-modal-body').empty();
		$('#layout-modal .gdz-modal-title').text('Column Settings');
		$('#layout-modal #save-settings').data('flag', 'column-setting');
		var $clone = $('.column-settings').clone(true);
		$clone.randomIds();
		$clone = $('#layout-modal').find('.gdz-modal-body').append( $clone );
    var column_id = $parent.attr('id');
    var column_setting = $parent.data('settings');
		$clone.find('.addon-input').each(function(){
			var $that = $(this);
			var	attrValue = $that.data('attrname');
			$that.setInputValue({filed: column_setting[attrValue]});
		});

		$('#layout-modal').modal();
    $clone.find('.color-picker-component').colorpicker();
    loadFancyBox();
	});
  $(document).on("click",".gdz-modal .nav a",function(){
      tab = $(this).attr("href");
      $(".gdz-modal .tab-content div").each(function(){
          $(this).removeClass("active");
      });
      $(".gdz-modal .tab-content "+tab).addClass("active");
  });
	$(document).on('click','.remove-row',function(event) {
		event.preventDefault();
		if ( confirm("Click Ok button to delete Row, Cancel to leave.") == true )
		{
      var row_id = $(this).closest('.row').attr('id');
			$(this).closest('.row').slideUp(200, function(){
				$(this).remove();
			});
		}
	});
  //change media value input text
  $(document).on('change keyup', '.input-media', function() {
      $(this).parent().find('.media-image-preview').css('background-image','url(' + root_url + $(this).val() + ')');
  })
	$.fn.updateClass = function(str2){
		$parent = $('.column-active');
		var classes = $parent.attr('class').split(" ");
		for (var i = 0, len = classes.length; i < len; i++)
			if(classes[i].indexOf(str2)!= -1) {
				$parent.removeClass(classes[i]);
			}
			$parent.addClass(this.getInputValue());
	}
	$(document).on('click','#save-settings',function(event) {
		event.preventDefault();
		var flag = $(this).data('flag');
		switch(flag){
			case 'row-setting':
        var $parent = $('.row-active'),
        settings = $parent.data('settings');
				$('#layout-modal').find('.addon-input').each(function(){
					var $this = $(this),
					$attrname = $this.data('attrname');
					$parent.removeData( $attrname );
					if ($attrname == 'name') {
						var nameVal = $this.val();
						if (nameVal  !='' || $this.val() != null) {
							$('.row-active .row-name').text($this.val());
						} else {
							$('.row-active .row-name').text('Row');
						}
					}
          settings[$attrname] = $this.getInputValue();
				});
        $parent.data('settings', settings);
				break;

			case 'column-setting':
        var $parent = $('.column-active'),
        settings = $parent.data('settings');
				$('#layout-modal').find('.addon-input').each(function(){
					var $this = $(this),
					$attrname = $this.data('attrname');
					$parent.removeData( $attrname );
          if($attrname == 'lg_col') {
						$this.updateClass('col-lg-');
					}
					if($attrname == 'sm_col') {
						$this.updateClass('col-sm-');
					}
					if($attrname == 'xs_col') {
						$this.updateClass('col-xs-');
					}
          settings[$attrname] = $this.getInputValue();
				});
        $parent.data('settings', settings);
				break;
			default:
				alert('You are doing somethings wrongs. Try again');
		}
	});

	$(document).on('click','#save-addons',function(event) {
		event.preventDefault();
		var flag = $(this).data('flag');
		switch(flag){
			case 'add-module':
				if($('#addon-modal').find('.addon-hook').val() != '') {
					var $parent = $('.column-active');
					var $clone = $('.hidden .module').clone(true);
					var modulename = $('#addon-modal').find('.addon-modulename').val();
					$clone.find('.addon-title').html(modulename);
					$('#addon-modal').find('.addon-input').each(function(){
						var $this = $(this),
						$attrname = $this.data('attrname');
						$clone.removeData( $attrname );
						$clone.attr('data-' + $attrname, $this.getInputValue());
					});
					$parent.find('.column').append($clone);
				} else {
					alert('You must select a Hook Name. If Module dont have any avaiable Hook Name You cant add it to layout!');
				}
				break;
			case 'edit-module':
				if($('#addon-modal').find('.addon-hook').val() != '') {
					var $clone = $('.hidden .module').clone(true);
					var modulename = $('#addon-modal').find('.addon-modulename').val();
					$clone.find('.addon-title').html(modulename);
					$('#addon-modal').find('.addon-input').each(function(){
						var $this = $(this),
						$attrname = $this.data('attrname');
						$clone.removeData( $attrname );
						$clone.attr('data-' + $attrname, $this.getInputValue());
					});
					$('.addon-active').replaceWith($clone);
				} else {
					alert('You must select a Hook Name. If Module dont have any avaiable Hook Name You cant add it to layout!');
				}
				break;
			case 'add-addon':
				var $original = $('#addon-modal').find('.addon-box');
				$original.cleanRandomIds();
				var $clone = $original.clone();
        $clone.attr('id', `addon-${genID()}`);
        $('.ui-state-highlight').replaceWith($clone);
				break;
			case 'edit-addon':
				var $original = $('#addon-modal').find('.addon-box');
				$original.cleanRandomIds();
				var $clone = $original.clone();
        $clone.attr('id', `addon-${genID()}`);
				$('.addon-active').replaceWith($clone);
				break;
			default:
				alert('You are doing somethings wrongs. Try again');
		}
	});

	//Filter Addons
	$(document).on('click', '#modal-addons .addon-filter ul li a', function(){
		var $self = $(this);
		var $this = $(this).parent();
		$self.closest('ul').children().removeClass('active');
		$self.parent().addClass('active');
		if($this.data('category')=='all') {
			$('#modal-addons').find('.pagebuilder-addons').children().removeAttr('style');
			return true;
		}
		$('#modal-addons').find('.pagebuilder-addons').children().each(function(){
			if($(this).hasClass( 'addon-cat-' + $this.data('category') )) {
				$(this).removeAttr('style');
			} else {
				$(this).css('display', 'none');
			}
		});
	});
	//Remove Addon
	$(document).on('click', '.remove-addon', function(event){
		event.preventDefault();
		if ( confirm("Click Ok button to delete Block, Cancel to leave.") == true )
		{
			$(this).closest('.addon-box').slideUp(200, function(){
				$(this).remove();
			});
		}
	});
	//Edit Addon
	$(document).on('click', '.edit-addon', function(event){
		event.preventDefault();
		$('.layout-column').removeClass('column-active');
		$('.addon-box').removeClass('addon-active');
		$(this).parent().closest('.layout-column').addClass('column-active');
		$(this).closest('.addon-box').addClass('addon-active');
		$('#addon-modal').find('.gdz-modal-body').empty();
		$('#addon-modal .gdz-modal-title').text($('.addon-active').find('.addon-title').html());
		$('#addon-modal #save-addons').data('flag', 'edit-addon');
		var $clone = $('.addon-active').clone(true);
		$clone.randomIds();
		$clone.removeClass('addon-active');
		$('#addon-modal').find('.gdz-modal-body').append( $clone );
		$('#addon-modal').modal('show');
		$('#addon-modal').find('.gdz-editor').each(function(){
			var $id = $(this).attr('id');
			tinyMCE.execCommand('mceAddEditor', false, $id);
		});
    reLoadUI();
	});
	$(document).on('click', '.duplicate-row', function(event){
		event.preventDefault();
		$('.row').removeClass('row-active');
		$(this).closest('.row').addClass('row-active');
		var $clone = $('.row-active').clone();
    $clone.attr('id', `row-${genID()}`);
    $($clone).find('.layout-column').each(function(){
        $(this).attr("id", `column-${genID()}`);
    });
		$clone.removeClass('row-active');
    $clone.insertAfter($('.row-active'));
    //copy row setting
    $($clone).data('settings', $('.row-active').data('settings'));
		UiSort();
		UiTooltip();
	});
	$(document).on('click', '.duplicate-addon', function(event){
		event.preventDefault();
		$('.addon-box').removeClass('addon-active');
		$(this).closest('.addon-box').addClass('addon-active');
		var $clone = $('.addon-active').clone();
		$clone.removeClass('addon-active');
    $clone.attr('id', `addon-${genID()}`);
		$(this).closest('.column').append($clone);
    updateColumnAddonJson();
	});
	$('.show-fancybox').fancybox({
		type: 'iframe',
		autoDimensions: false,
		autoSize: false,
		arrows : false,
		width: 600,
		height: 500,
		helpers: {
			overlay: {
				locked: false
			}
		}
	});
	$(document).on('click','.remove-media',function(event) {
		var fid = $(this).attr('id');
		var fid = fid.substring(13, 20);
		$('#media-preview-' + fid).attr('src','');
		$('#gdz-image-' + fid).val('');
	});
	$(document).on('click','.import-link',function(event) {
		$('.import-form').toggle();
		$('.language-form').hide();
	});
	$(document).on('click','.copy-lang',function(event) {
		$('.language-form').toggle();
		$('.import-form').hide();
	});
	$(document).on('click','.device-icons li',function(event) {
		$('#rowlist').removeClass();
		$('#rowlist').addClass($(this).data('device') + '-layout');
		if($(this).data('device') != 'xl')
			$('.layout-action').addClass('disabled');
		else
			$('.layout-action').removeClass('disabled');
		$('.device-icons li').removeClass('active');
    $('#tool-device .dropbtn').html($(this).find('.icon').html());
		$(this).addClass('active');
	});
  //search addon
  $(document).on('keyup','#search-addon',function(event) {
      var filter, ul, li, txtValue;
      filter = $(this).val().toUpperCase();
      li = $(".pagebuilder-addons li.addon-cat-addons");
      li.each(function(){
          txtValue = $(this).find('.element-title').text();
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
              $(this).show();
          } else {
              $(this).hide();
          }
      });
	});
	$(document).on('change',"#select-page",function(event) {
		document.location = $('#backend_url').val() + '&config_id_page=' + $(this).val() + '&id_lang=' + $('#select-language').val();
	})
  $(document).on('change',"#select-language",function(event) {
		  document.location = $('#backend_url').val() + '&config_id_page=' + $('#select-page').val() + '&id_lang=' + $(this).val();
	})
  //templates
  $(document).on('click', '#save-template-file', function(event){
      event.preventDefault();
      event.stopPropagation();
      var config = JSON.stringify(getLayout());
      var filename = $('#library-file-name').val();
      if(filename == '') {
          alert('Please enter file name');
          return;
      }
      blob = new Blob([config], { type: 'text/plain' }),
      anchor = document.createElement('a');

      anchor.download = filename + '.json';
      anchor.href = (window.webkitURL || window.URL).createObjectURL(blob);
      anchor.dataset.downloadurl = ['text/plain', anchor.download, anchor.href].join(':');
      anchor.click();
  });
  saveTemplate = function() {
      config = JSON.stringify(getLayout());
      if($('#library-template-name').val() == '') {
          alert('Please enter template name');
          return;
      }
      $.ajax({
          type: 'POST',
          url: PagebuilderConfig.editor_link + '&action=SaveTemplate&ajax=1',
          data: {
              jsonparams: config,
              templatename: $('#library-template-name').val(),
          },
          success: function(data)
          {
              switchDialogForm('library');
          }
      });
  }
  $('#library-save-template').click(function(e) {
      event.preventDefault();
      event.stopPropagation();
      saveTemplate();
  })
  assignData = function(pageObj, dom) {
      pageObj.forEach(function(row) {
        rowId = row.id;
        if (rowId) {
          $(dom).find(`#${rowId}`).data('settings', row.settings);
        }
        row.cols.forEach(function(col) {
          colId = col.id;
          if (colId)
            $(dom).find(`#${colId}`).data('settings', col.settings);
          col.addons.forEach(function(addon) {
            addonId = addon.id;
            if (addonId) {
              $(dom).find(`#${addonId}`).data('settings', addon.fields);
            }
          })
        })
      })
  }
  $(document).on('click', '.template-import', function(event){
      event.preventDefault();
      event.stopPropagation();
      var template_row = $(this).closest('.template-row');
      $('.pagebuilder-dialog-close').trigger('click');
      $('.pagebuilder-preview-overlay').show();
      $.ajax({
          type: 'POST',
          url: PagebuilderConfig.backend_link + '&action=ImportTemplate&ajax=1',
          data: {
              id_template: template_row.attr('data-id')
          },
          success: function(data)
          {
              data = JSON.parse(data);
              iframeDoc = window.iframeDoc;
              template = $(data.html);
              wrapper = $('<div></div>').html(template);
              assignData(data.params, wrapper);
              $('#rowlist .rowlist').append(template);
          		UiSort();
          		UiTooltip();

          }
      });
  });
  $(document).on('click','#page-save',function(event) {
  		var params = JSON.stringify(getLayout());
  		$('#gdzformjson').val( params );
  		var layoutForm = document.layoutForm;
  		layoutForm.submit();
	});
});
