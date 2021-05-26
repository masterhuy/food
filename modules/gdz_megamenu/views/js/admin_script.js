/**
* @package Godzilla MegaMenu
* @version 1.0
* @Copyright (C) 2009 - 2020 Godzilla.
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
* @Website: https://www.godzillabuilder.com
**/

function checkAll(cbox) {
	var form = document.adminForm;
	var boxs = $(".gdz-checkbox");
	if (cbox.checked)
		cvalue = true;
	else
		cvalue = false;
		form.boxchecked.value = '';
	for(i=0;i<boxs.length;i++) {
		boxs[i].checked = cvalue;
	}
}
function isChecked(c) {
	var form = document.adminForm;
	if (c.checked)
		form.boxchecked.value = c.value;
	else if(form.boxchecked.value==c.value)
		form.boxchecked.value = null;
}
function submitform(task,link) {
	var form = document.adminForm;
	if (task=='add') {
		document.location = link;
	} else if(task=='edit') {
		var form = document.adminForm;
		if (form.boxchecked.value)
			document.location = link + '&mitem_id=' + form.boxchecked.value;
		else
			alert('Please select one item to edit');
	} else if(task=='deleteItem'){
		var boxs = $(".gdz-checkbox");
		var can_del = false;
		for(i=0;i<boxs.length;i++) {
			if (boxs[i].checked)
				can_del = true;
		}
		if (!can_del) {
			alert('Please select one item to delete');
		} else {
			form.action = link + '&'+ task;
			form.submit();
		}
	} else if(task=='cStatus'){

		var boxs = $(".gdz-checkbox");
		var can_change = false;
		for(i=0;i<boxs.length;i++) {
			if (boxs[i].checked)
				can_change = true;
		}
		if (!can_change) {
			alert('Please select one item to change');
		} else {
			form.action = link + '&'+ task;
			form.submit();
		}
	}
	return false;
}

function cStatus(id,link,status) {
	var form = document.adminForm;
	$('#' + id).prop('checked', true);
	form.action = link + '&cStatus&status=' + status;
	form.submit();
}

function cRemove(id,link) {
	var form = document.adminForm;
	$('#' + id).prop('checked', true);
	var choice = confirm('Are you sure to delete this item ?');
	if (choice) {
		form.action = link + '&deleteItem';
		form.submit();
	}

}

function _initload() {
	var  jms_box = $('.gdz-box');
	jms_box.hide();
	$('.' + $("#type").val()).show();
	if ($("#parent_id").val() > 0) {
		$('.level1').hide();
		$('.level2').show();
	} else {
		$('.level1').show();
		$('.level2').hide();
	}
}
function collapse_expand() {
	$('.collapse-expand').click(function (e) {
	    e.preventDefault();
	    var _menu = $(this).parent().parent().parent();
	    var _submenu = _menu.find('.gdz-submenu');
	    _submenu.toggle();
			if ($(this).children('i').html() == 'remove') {
				$(this).children('i').html('add');
			} else {
				$(this).children('i').html('remove');
			}
    })
	$('.collapse-expand-all').click(function (e) {
		$('.gdz-submenu').toggle();
		if ($(this).children('i').html() == 'remove') {
				$(this).children('i').html('add');
		} else {
			$(this).children('i').html('remove');
		}
	})
}
$(document).ready(function() {
	_initload();
	$("#type").change(function() {
			_initload();
	});
	$("#parent_id").change(function() {
			_initload();
	});
	collapse_expand();

	$("#add-menu").click(function() {
			$('#add-menu-form').toggle();
	});
	$("#page-header-desc-configuration-delete_items").click(function(d) {
		d.preventDefault();
		d.stopPropagation();
			var boxs = $(".gdz-checkbox");
			var can_del = false;
			for(i=0;i<boxs.length;i++) {
				if (boxs[i].checked)
					can_del = true;
			}
			if (!can_del) {
				alert('Please select one item to delete');
				return;
			} else {
				var choice = confirm('Are you sure to delete items ?');
	      if (choice) {
					var form = document.adminForm;
					form.action = $(this).attr('href');
					form.submit();
	      }
			}
	});
	$("#page-header-desc-configuration-active_items").click(function(d) {
		d.preventDefault();
		d.stopPropagation();
			var boxs = $(".gdz-checkbox");
			var can_del = false;
			for(i=0;i<boxs.length;i++) {
				if (boxs[i].checked)
					can_del = true;
			}
			if (!can_del) {
				alert('Please select one item to delete');
				return;
			} else {
				var form = document.adminForm;
				form.action = $(this).attr('href');
				form.submit();
			}
	});
	$("#page-header-desc-configuration-unactive_items").click(function(d) {
		d.preventDefault();
		d.stopPropagation();
			var boxs = $(".gdz-checkbox");
			var can_del = false;
			for(i=0;i<boxs.length;i++) {
				if (boxs[i].checked)
					can_del = true;
			}
			if (!can_del) {
				alert('Please select one item to delete');
				return;
			} else {
				var form = document.adminForm;
				form.action = $(this).attr('href');
				form.submit();
			}
	});
	$('.delete-link').click(function(d) {
			d.preventDefault();
			d.stopPropagation();
			var choice = confirm(this.getAttribute('data-confirm'));
      if (choice) {
        window.location.href = this.getAttribute('href');
      }
	});
	$('.mytooltip').tooltip();
});
