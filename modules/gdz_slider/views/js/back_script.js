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
	var style = 'desktop';
	var image_update = false;
	var editor = false;
	function drawRuler() {
		d = $('.wrap-slider').offset().left - $('#frame_layer').offset().left;
		if ($('.wrap-slider').width() > $('#frame_layer').width()) {
			min_hor = Math.round(d/100)*100;
			$('#hor-css-linear').css('width', '100%');
		} else {
			min_hor = 0;
			$('#hor-css-linear').css('width', $('#frame_layer').width()+'px');
		}
		left = min_hor - d;
		$("#hor-css-linear").css('left', left + 'px');
		var horl = jQuery('#hor-css-linear .linear-texts'),
					verl = jQuery('#ver-css-linear .linear-texts'),
					maintimer = jQuery('#mastertimer-linear .linear-texts');
			horl.empty();
			verl.empty();
			maintimer.empty();
			mw = $('#hor-css-linear').width();
			mh = $('#ver-css-linear').height();
		for (var i=min_hor;i<mw;i=i+100) {
			if (mw-i<100)
				horl.append('<li style="width:'+(mw-i)+'px"><span>'+i+'</span></li>');
			else
				horl.append('<li><span>'+i+'</span></li>');
		}
		for (var i=0;i<mh;i=i+100) {
			verl.append('<li><span>'+i+'</span></li>');
		}
		for (var i=0;i<160;i=i+1) {
			var txt = i+"s";
			maintimer.append('<li><span>'+txt+'</span></li>');
		}
	}
	function setCoordinates(x, y) {
		d = $('.wrap-slider').offset().left - $('#frame_layer').offset().left;
		if (x !== false) {
			x = parseInt(x);
			$('#verlinie').css('left', x+Math.abs(d)+'px');
			$('#verlinetext').html(x);
		}
		if (y !== false) {
			y = parseInt(y);
			$('#horlinie').css('top', y+40+'px');
			$('#horlinetext').html(y);
		}
	}
	function closeLayerList() {
		$('.layer-container').slideUp('fast');
		$('#quick-list').find('i').html('list');
		$('#quick-list').closest('.row').removeClass('active');
	}
	function openEditor(text, data_type) {
		editor = true;
		closeLayerList();
		$('.editor').slideDown('fast');
		$('#text-editor').attr('data-type', data_type);
		$('.action').css('display', 'none');
		$('.confirm').css('display', 'inline-block');
		$('#quick-edit').closest('.row').addClass('active');
		$('#text-editor').val(text);
		$('#quick-cancel').attr('data-text', text);
	}
	function openModal() {
		image_update = true;
		modal = $('#modal_add_image');
		id = $('#id_layer').val();
		modal.find('#title_image_new').val($('input[name=data_title_'+id+']').val());
		// modal.append('<input type="hidden" name="updateImage" value="1">');
		modal.modal('show');
	}
	function changeImage(currentId, img) {
		$('#image_layer_' + currentId).remove();
		$('#caption_' + currentId).append('<img  width="100%" height="100%" id="image_layer_' + currentId + '" src="' + $('#site_url').val() + 'modules/gdz_slider/views/img/layers/' + img + '" />');
	}
	function closeEditor() {
		editor = false;
		$('.editor').slideUp('fast');
		$('.action').css('display', 'inline-block');
		$('.confirm').css('display', 'none');
		$('#quick-editor').closest('.row').removeClass('active');
	}
	// transform animation
	$("select[name^='data_transform_in'], select[name^='data_transform_out']").change(function() {
		var name = $(this).attr('name');
		var layer_id = name.substring($(this).attr('data-id').length+1);
		var animation = $(this).val();
		$("#caption_"+layer_id).addClass(animation+ " animated").on("animationend", function() {
			$("#caption_"+layer_id).removeClass(animation+" animated");
		});

	})
	$('.toogle').click(function (e) {
		$('#layersContent').toggle(200);
	});
	$('.panel-heading').click(function (e) {
		$(this).next('.form-wrapper').toggle(200);
	});
	$('#add-text').on('click', function () {
		$('#modal_add_text').modal('show');
	});
	$('#add-image').on('click', function () {
		$('#modal_add_image').modal('show');
	});
	if ($("#data_image_action_select").prop("checked")) {
		$('#form_select_image').show();
		$('#form_upload_image').hide();
	} else {
		$('#form_select_image').hide();
		$('#form_upload_image').show();
	}
	$('#data_image_action_upload').click(function () {
		$('#form_select_image').hide();
		$('#form_upload_image').show();
	});
	$('#data_image_action_select').click(function () {
		$('#form_select_image').show();
		$('#form_upload_image').hide();
	});

	$('#add-video').on('click', function () {
		$('#modal_add_video').modal('show');
	});
	$('#tips').on('click', function () {
		$('#modal_tips').modal('show');
	});
	$('.data_video_bg').click(function () {
		strId = $(this).attr('id');
		currentId = strId.substring(14, 20);
		var s_width = $('.slide').width();
		var s_height = $('.slide').height();
		var width_current = $('#data_width_' + currentId).val();
		var height_current = $('#data_height_' + currentId).val();
		var x_current = $('#data_x_' + currentId).val();
		var y_current = $('#data_y_' + currentId).val();
		if ($('.data_video_bg').is(':checked')) {
			$('#data_video_bg_' + currentId).val('1');
			$('#caption_' + currentId).css({
				'width' : s_width + 'px',
				'height' : s_height + 'px',
				'top' : 0,
				'left' : 0
			});

		} else {
			$('#data_video_bg_' + currentId).val('0');
			$('#caption_' + currentId).css({
				'width' : width_current + 'px',
				'height' : height_current + 'px',
				'top' : (y_current / s_height) * 100 + '%',
				'left' : (x_current / s_width) * 100 + '%'
			});
		}
	});

	//show hide layer depend on id
	$('.panel-layers .form-layer').first().show();
	$('.tp-caption').css("cursor", "move");
	$('.layer').click(function () {
		strId = $(this).attr('id');
	    patt1 = /\d+$/g;
	    currentId = strId.match(patt1);
		$('.layer').removeClass('active')
		$(this).addClass('active');
		$('#caption_' + currentId).addClass('active');
		form_layer = $('.form-layer');
		form_layer_id = $('#form_layer_' + currentId);
		form_layer.hide();
		form_layer_id.show();
		if (style == 'mobile') {
			data_show = 'data_mshow_';
			setCoordinates($('input[name=data_mx_'+currentId+']').val(), $('input[name=data_my_'+currentId+']').val());
		} else if (style == 'mobile2') {
			data_show = 'data_m2show_';
			setCoordinates($('input[name=data_m2x_'+currentId+']').val(), $('input[name=data_m2y_'+currentId+']').val());
		} else if (style == 'tablet') {
			data_show = 'data_tshow_';
			setCoordinates($('input[name=data_tx_'+currentId+']').val(), $('input[name=data_ty_'+currentId+']').val());
		}
		else {
			data_show = 'data_show_';
			setCoordinates($('#data_x_'+currentId).val(), $('#data_y_'+currentId).val());
		}
		if (parseInt($('input[name='+data_show+currentId+']').val()))
			$('#quick-show').find('i').removeClass('layer-hide');
		else
			$('#quick-show').find('i').addClass('layer-hide');
		$('#mastertimer_'+currentId).addClass('active');
		$('#layer_'+currentId).addClass('active');
		$('#quick-title').val($('input[name=data_title_'+currentId+']').val());
		$('#id_layer').val(currentId);
		$('#type_layer').val($('input[name=data_type_'+currentId+']').val());

	});

	// $('.tp-caption').click(function () {
	// 	strId = $(this).attr('id');
	// 	currentId = strId.substring(8, 20);
	// 	$('.layer').removeClass('active');
	// 	$(this).addClass('active');
	// 	$('.layers-' + currentId).addClass('active');
	// 	form_layer = $('.form-layer');
	// 	form_layer_id = $('#form_layer_' + currentId);
	// 	form_layer.hide();
	// 	form_layer_id.show();
	// 	$('#mastertimer_'+currentId).addClass('active');
	// 	$('#id_layer').val(currentId);

	// });
	// SHow and hide layer to easy work with
	$('.show-hide-layer').toggle( function(){
		lstr = $(this).parents('.layer').attr('id');
		lId = lstr.substring(7, 20);
		$('#caption_'+lId).fadeOut();
		$(this).removeClass('btn-default');
		$(this).addClass('btn-warning');
		$(this).find('.icon-eye').hide();
		$(this).find('.icon-eye-slash').show();
	},function(){
		lstr = $(this).parents('.layer').attr('id');
		lId = lstr.substring(7, 20);
		$('#caption_'+lId).fadeIn();
		$(this).removeClass('btn-warning');
		$(this).addClass('btn-default');
		$(this).find('.icon-eye').show();
		$(this).find('.icon-eye-slash').hide();
	});

	///handle image upload
	$('#data_image-selectbutton').click(function (e) {
		$('#data_image').trigger('click');
	});

	$('#data_image').change(function (e) {
		var val = $(this).val();
		var file = val.split(/[\\/]/);
		$('#data_image-name').val(file[file.length - 1]);
	});

	$('#data_image_new-selectbutton').click(function (e) {
		$('#data_image_new').trigger('click');
	});

	$('#data_image_new').change(function (e) {
		var val = $(this).val();
		var file = val.split(/[\\/]/);
		$('#data_image_new-name').val(file[file.length - 1]);
	});

	$('.data-image').change(function (e) {
		var img = $(this).val();
		strId = $(this).attr('id');
		currentId = strId.substring(11, 20);
		$('#image_layer_' + currentId).remove();
		$('#caption_' + currentId).append('<img  width="100%" height="100%" id="image_layer_' + currentId + '" src="' + $('#site_url').val() + 'modules/gdz_slider/views/img/layers/' + img + '" />');
	});
	$('.data-width').keyup(function (e) {
		var html = $(this).val();
		strId = $(this).attr('id');
		currentId = strId.substring(11, 20);
		var s_width = $('.slide').width();
		width_current = $('#data_width_' + currentId).val();
		if (width_current == 'full') {
			$('#caption_' + currentId).css({
				'width' : s_width + 'px',
				'left' : 0
			});
			$('#data_x_' + currentId).val(0);
			$('#data_y_' + currentId).val(0);
			$('#data_width_' + currentId).val(s_width);
		} else if (width_current == 'half') {
			$('#caption_' + currentId).css({
				'width' : Math.round(s_width / 2) + 'px'
			});
			$('#data_width_' + currentId).val(Math.round(s_width / 2));
		} else if (width_current == 'quarter') {
			$('#caption_' + currentId).css({
				'width' : Math.round(s_width / 4) + 'px'
			});
			$('#data_width_' + currentId).val(Math.round(s_width / 4));
		} else {
			$('#caption_' + currentId).css({
				'width' : width_current + 'px'
			});
		}
	});

	$('.data-height').keyup(function (e) {
		var html = $(this).val();
		strId = $(this).attr('id');
		currentId = strId.substring(12, 20);
		var s_height = $('.slide').height();
		height_current = $('#data_height_' + currentId).val();
		if (height_current == 'full') {
			$('#caption_' + currentId).css({
				'height' : s_height + 'px',
				'top' : 0
			});
			$('#data_x_' + currentId).val(0);
			$('#data_y_' + currentId).val(0);
			$('#data_height_' + currentId).val(s_height);
		} else if (height_current == 'half') {
			$('#caption_' + currentId).css({
				'height' : Math.round(s_height / 2) + 'px'
			});
			$('#data_height_' + currentId).val(Math.round(s_height / 2));
		} else if (height_current == 'quarter') {
			$('#caption_' + currentId).css({
				'height' : Math.round(s_height / 4) + 'px'
			});
			$('#data_height_' + currentId).val(Math.round(s_height / 4));
		} else {
			$('#caption_' + currentId).css({
				'height' : height_current + 'px'
			});
		}
	});

	$('input[name^=data_title_]').keyup(function (e) {
		var title = $(this).val();
		currentId = getId(this, true);
		$("#quick-title").val(title);
		$('#layer_'+currentId+' .quick-tittle').val(title);
	});

	$('.data-font-size').keyup(function (e) {
		var html = $(this).val();
		currentId = getId(this, true);
		$('#caption_' + currentId).css({
			'font-size' : html + 'px'
		});
	});

	$('.data-style').change(function (e) {
		var html = $(this).val();
		currentId = getId(this);
		$('#caption_' + currentId + ' span').css({
			'font-style' : html
		});
	});

	$('.data-font-weight').keyup(function (e) {
		var html = $(this).val();
		currentId = getId(this);
		$('#caption_' + currentId + ' span').css({
			'font-weight' : html
		});
	});
	$('.data-color').change(function (e) {
		var html = $(this).val();
		strId = $(this).attr('id');
		currentId = strId.substring(11, 20);
		$('#caption_' + currentId + ' span').css({
			'color' : html
		});
	});

	// Submit text
	$('#submitLayerText').click(function (e) {
		$('.loading.loading-text').show();
		id_slide = $('#id_slide').val();
		title_text_new = $('#title_text_new').val();
		layer_text_new = $('#text_layer_new').val();
		url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action=addLayer';
		$.ajax({
			type : "POST",
			url : url,
			data : {
				'id_slide' : id_slide,
				'data_title' : title_text_new,
				'data_text' : layer_text_new,
				'data_type' : 'text',
				'secure_key' : secure_key,
			},
				// 'id_slide=' + id_slide + '&data_title=' + title_text_new + '&data_text=' + layer_text_new + '&data_type=text',
			success : function (result) {
				location.reload(true);
			},
			error : function () {
				alert('Error401');
			},
			dataType : 'html'
		});
		return false;
	});

	// SUbmit text
	$('#title_text_new').keypress(function (e) {
		if (e.which == 13) {
			$('.loading.loading-text').show();
			id_slide = $('#id_slide').val();
			title_text_new = $('#title_text_new').val();
			layer_text_new = $('#text_layer_new').val();
			url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action=addLayer';
			$.ajax({
				type : "POST",
				url : url,
				data : {
					'id_slide' : id_slide,
					'data_title' : title_text_new,
					'data_text' : layer_text_new,
					'data_type' : 'text',
					'secure_key' : secure_key,
				},
				success : function (result) {
					location.reload(true);
				},
				error : function () {
					alert('Error401');
				},
				dataType : 'html'
			});
			return false;
		}

	});

	function Validate(oForm) {
		var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];
		var arrInputs = oForm.getElementsByTagName("input");
		for (var i = 0; i < arrInputs.length; i++) {
			var oInput = arrInputs[i];
			if (oInput.type == "file") {
				var sFileName = oInput.value;
				if (sFileName.length > 0) {
					var blnValid = false;
					for (var j = 0; j < _validFileExtensions.length; j++) {
						var sCurExtension = _validFileExtensions[j];
						if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
							blnValid = true;
							break;
						}
					}
				}
			}
		}
		return blnValid;
	}
	//quick list process
	$('#quick-list').click(function () {
		row = $(getParentByClassName(this, 'row'));
		if ($('.layer-container').is(":visible")) {
			closeLayerList();
		} else {
			closeEditor();
			$('.layer-container').slideDown('fast');
			if ($('.layer-container').children().length > 0)
				$(this).find('i').html('arrow_upward');
			$(getParentByClassName(this, 'row')).addClass('active');
		}
	})
	$(document).mousedown(function(e) {
		var element = $('#quick-layer-selector');
		if (!element.is(e.target) && element.has(e.target).length === 0) {
			closeLayerList();
			if (editor) {
				$('#quick-check').click();
				closeEditor();

			}
		}
	})
	function hideLayer(id) {
		if (id == undefined) {
			id = $('#id_layer').val();
			$('#quick-show').find('i').addClass('layer-hide');
		}
		if (style=='mobile') {
			$('input[name=data_mshow_'+id+']').val(0);
		} else {
			$('input[name=data_show_'+id+']').val(0);
		}
		$('#caption_'+id).hide();
		$('#layer_'+id+' .quick-show').find('i').addClass('layer-hide');
	}
	function showLayer(id) {
		if (id == undefined) {
			id = $('#id_layer').val();
			$('#quick-show').find('i').removeClass('layer-hide');
		}
		if (style=='mobile') {
			$('input[name=data_mshow_'+id+']').val(1);
		} else {
			$('input[name=data_show_'+id+']').val(1);
		}
		$('#caption_'+id).show();
		$('#layer_'+id+' .quick-show').find('i').removeClass('layer-hide');
	}
	$('.quick-show').click(function() {
		id = getId(this.closest('.row'));
		if ($(this).find('i').hasClass('layer-hide'))
			showLayer(id);
		else
			hideLayer(id);
	})
	$('.quick-edit').click(function() {
		if ($('#id_layer').val() == '0') return;
		closeLayerList();
		id = $(this).closest('.row').attr('id');
		if (id != undefined) {
		    patt1 = /\d+$/g;
		    currentId = id.match(patt1);
			$('#id_layer').val(currentId);
			$('#type_layer').val($('input[name=data_type_'+currentId+']').val());
		}
		type = $('#type_layer').val();
		if (type == 'text') {
			text = $('#data_html_'+$('#id_layer').val()).val();
			openEditor(text, 'text');
		} else if (type == 'image') {
			openModal();
		} else if (type == 'video') {
			url = $('#data_video_'+$('#id_layer').val()).val();
			openEditor(url, 'video');
		}
	})
	$('#quick-check').click(function() {
		url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action=quickEdit';
		text = $('#text-editor').val();
		id_layer = $('#id_layer').val();
		type = $('#text-editor').attr('data-type');
		$.ajax({
			type : "POST",
			url : url,
			data : {
				'text': text,
				'id_layer': id_layer,
				'type': type,
				'secure_key': secure_key,
			},
				// 'text=' + text + '&id_layer=' + id_layer + '&type=' + type,
			success : function (result) {
				data = JSON.parse(result);
				if (data.status) {
					closeEditor();
					if (type == 'video') {
						location.reload(true);
					}
				}
			},
			error : function () {
				alert('Error401');
			},
			dataType : 'html'
		});

	})
	$('#text-editor').keyup(function() {
		id = $('#id_layer').val();
		if ($(this).attr('data-type') == 'text') {
			$('#data_html_'+id).val($(this).val());
			$('#caption_' + id + ' span').html($(this).val());
		}
	})
	$('#quick-cancel').click(function() {
		closeEditor();
		text = $(this).attr('data-text');
		$('#data_html_'+id).val(text);
		$('#caption_' + id + ' span').html(text);
	})
	// submit image
	$('#form_add_layer').on('submit', function (e) {
		e.preventDefault();
		id_slide = $('#id_slide').val();
		title_image_new = $('#title_image_new').val();
		layer_image_new = $('#data_s_image').val();
		form_data = new FormData(this);
		form_data.append('secure_key', secure_key);
		if (image_update) {
			form_data.append('update', true);
			form_data.append('id_layer', $('#id_layer').val());
			action = 'updateImageLayer';
			image_update = false;
		} else {
			action = 'addLayer';
		}
		url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action='+action+'&data_type=image&id_slide=' + id_slide;
		var input = document.getElementById('data_image');
		var file = input.files[0];
		if (input.files[0] && !Validate(this)) {
			$('.show-error').html('Image format incorrect. Try again!');
			return false;
		} else if (input.files[0] && file.size > 2097152) {
			$('.show-error').html('Image size too large (max is 2Mb). Try again!');
			return false;
		} else {
			$('.loading.loading-image').show();
			$('.show-error').hide();
			$.ajax({
				type : "POST",
				url : url,
				contentType : false, // The content type used when sending data to the server.
				cache : false, // To unable request pages to be cached
				processData : false,
				data : form_data,
				success : function (result) {
					if (result == '') {
						location.reload(true);
					} else {
						data = JSON.parse(result);
						if (data.update) {
							$('.loading.loading-image').hide();
							$('#modal_add_image').modal('hide');
							id_layer = form_data.get('id_layer');
							title = $('#title_image_new').val();
							$('#title_image_new').val('');
							changeImage(id_layer, data.img);
							$('#layer_'+id).find('.quick-tittle').val(title);
							$('#quick-title').val(title);
							$('input[name=data_title_'+id+']').val(title);
							$('#fulltime_title_'+id).html(title);
						}
					}
				},
				error : function () {
					alert('Error401');
				},
				dataType : 'html'
			});
		}

		return false;
	});

	$('#title_image_new').keypress(function(e){
       if(e.which == 13){//Enter key pressed
           e.preventDefault();
			id_slide = $('#id_slide').val();
			title_image_new = $('#title_image_new').val();
			layer_image_new = $('#data_s_image').val();
			url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action=addLayer&data_type=image&id_slide=' + id_slide;
			var input = document.getElementById('data_image');
			var file = input.files[0];
			form_data = new FormData(this);
			form_data.append('secure_key', secure_key);
			if (input.files[0] && !Validate(this)) {
				$('.show-error').html('Image format incorrect. Try again!');
				return false;
			} else if (input.files[0] && file.size > 2097152) {
				$('.show-error').html('Image size too large (max is 2Mb). Try again!');
				return false;
			} else {
				$('.loading.loading-image').show();
				$('.show-error').hide();
				$.ajax({
					type : "POST",
					url : url,
					contentType : false, // The content type used when sending data to the server.
					cache : false, // To unable request pages to be cached
					processData : false,
					data : form_data,
					success : function (result) {
						location.reload(true);
					},
					error : function () {
						alert('Error401');
					},
					dataType : 'html'
				});
			}

			return false;
       }
   	});
	$('#submitLayerVideo').click(function (e) {
		$('.loading.loading-text').show();
		id_slide = $('#id_slide').val();
		title_video_new = $('#title_video_new').val();
		layer_video_new = $('#data_video_new').val();
		url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action=addLayer';
		$.ajax({
			type : "POST",
			url : url,
			data : {
				'id_slide': id_slide,
				'data_title': title_video_new,
				'data_video': layer_video_new,
				'data_type': 'video',
				'secure_key': secure_key,
			},
				// 'id_slide=' + id_slide + '&data_title=' + title_video_new + '&data_video=' + layer_video_new + '&data_type=video',
			success : function (result) {
				location.reload(true);
			},
			error : function () {
				alert('Error401');
			},
			dataType : 'html'
		});
		return false;
	});

	$('#title_video_new').keypress(function (e) {
		if(e.which == 13){
			$('.loading.loading-text').show();
			id_slide = $('#id_slide').val();
			title_video_new = $('#title_video_new').val();
			layer_video_new = $('#data_video_new').val();
			url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action=addLayer';
			$.ajax({
				type : "POST",
				url : url,
				data : {
					'id_slide': id_slide,
					'data_title': title_video_new,
					'data_video': layer_video_new,
					'data_type': 'video',
					'secure_key': secure_key,
				},
				success : function (result) {
					location.reload(true);
				},
				error : function () {
					alert('Error401');
				},
				dataType : 'html'
			});
			return false;
		}

	});

	//delete layer
	function deleteLayer() {
		if (confirm('Are your sure delete this layer?')) {
			lId = $('#id_layer').val();
			url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action=deleteLayer';
			// return false;
			$.ajax({
				type : "POST",
				url : url,
				data : {
					'id_layer': lId,
					'secure_key': secure_key,
				},
				success : function (result) {
					$('#caption_' + lId).remove();
					$('#layer_' + lId).remove();
					$('#form_layer_' + lId).remove();
					$('#mastertimer_' + lId).remove();
					$('#fulltime_title_' + lId).remove();
					if ($('#frame_layer .layer').first().length == 0) {
						// $('.mastertimer-layer').hide();
						$('#quick-title').val('');
						$('#id_layer').val(0);
						setCoordinates(0,0);
					} else {
						$('#frame_layer .layer').first().trigger('click');
					}
				}, //end success
				error : function (xhr) {
					alert(xhr.response);
				},
				dataType : 'html'
			});

		} else {
			return false;
		}
	}
	// $('.delete_layer').click(deleteLayer);
	$('.quick-delete').click(function() {
		if ($('#id_layer').val() == '0') return;
		id = $(this).closest('.row').attr('id');
		if (id != undefined) {
		    patt1 = /\d+$/g;
		    currentId = id.match(patt1);
			$('#id_layer').val(currentId);
			$('#type_layer').val($('input[name=data_type_'+currentId+']').val());
		}
		deleteLayer();
	})
	 //end delete layer
	 //duplicate layer
	 function duplicateLayer() {
		url = $('#site_url').val() + 'modules/gdz_slider/ajax_gdz_slider.php?action=duplicateLayer';
		id_layer = $('#id_layer').val();
		$.ajax({
			type : "POST",
			url : url,
			data : {
				'id_layer': id_layer,
				'secure_key': secure_key,
			},
			success : function (result) {
				data = JSON.parse(result);
				if (data.duplicate) {
					location.reload(true);
				}
			},
			error : function () {
				alert('Error401');
			},
			dataType : 'html'
		});
	 }
	$('.quick-duplicate').click(function() {
		if ($('#id_layer').val() == '0') return;
		id = $(this).closest('.row').attr('id');
		if (id != undefined) {
		    patt1 = /\d+$/g;
		    currentId = id.match(patt1);
			$('#id_layer').val(currentId);
			$('#type_layer').val($('input[name=data_type_'+currentId+']').val());
		}
		duplicateLayer();
	})
	// $('#duplicate-layer').click(duplicateLayer);
	 //end duplicate layer
		var _mheight = $("#frame_layer").height();
		var _mwidth = $("#frame_layer").width();
		$('.tp-caption').draggable({
			stop: function(event, ui) {
				// Show dropped position.
				strId = $(this).attr('id');
				currentId = strId.substring(8, 20);
				var Stoppos = $(this).position();
				x = Math.round(Stoppos.left);
				y = Math.round(Stoppos.top);
				if (style=='mobile') {
					$('input[name=data_mx_' + currentId+']').val(x);
					$('input[name=data_my_' + currentId+']').val(y);
				} else if (style=='mobile2') {
					$('input[name=data_m2x_' + currentId+']').val(x);
					$('input[name=data_m2y_' + currentId+']').val(y);
				} else if (style=='tablet') {
					$('input[name=data_tx_' + currentId+']').val(x);
					$('input[name=data_ty_' + currentId+']').val(y);
				}else {
					$('#data_x_' + currentId).val(x);
					$('#data_y_' + currentId).val(y);
				}
				setCoordinates(x, y);

			}
		});
		$('.tp-caption').resizable({
			resize: function(event, ui) {
		     // gives you the current size of the div
		    var size = ui.size;
		  },
			// containment: 'children',
			stop: function(event, ui) {
				// Show dropped position.
				strId = $(this).attr('id');
				currentId = strId.substring(8, 20);
				var Stoppos = $(this).position();
				if (style=='mobile') {
					$('input[name=data_mwidth_' + currentId+']').val(Math.round($(this).width()));
					$('input[name=data_mheight_' + currentId+']').val(Math.round($(this).height()));
				} else if (style=='mobile2') {
					$('input[name=data_m2width_' + currentId+']').val(Math.round($(this).width()));
					$('input[name=data_m2height_' + currentId+']').val(Math.round($(this).height()));
				} else if (style=='tablet') {
					$('input[name=data_twidth_' + currentId+']').val(Math.round($(this).width()));
					$('input[name=data_theight_' + currentId+']').val(Math.round($(this).height()));
				}else {
					$('#data_width_' + currentId).val(Math.round($(this).width()));
					$('#data_height_' + currentId).val(Math.round($(this).height()));
				}
			}
		});

		$('.layer-time').resizable({
			handles: 'e',
			resize: function( event, ui ) {
				id = $(this).parent().attr('id').substr(12);
				width = Math.round($(this).width());
				$('input[name=data_time_'+id+']').val(width*10);
				$('#mastertimer-curtimeinner').html(width*10 + 'ms');
				$('#mastertimer-curtime').css('left',width + 'px');
			},
		});
		$('.delay-time').resizable({
			handles: 'e',
			resize: function( event, ui ) {
				id = $(getParentByClassName(this, 'mastertimer-layer')).attr('id').substr(12);
				width = Math.round($(this).width());
				$('input[name=data_delay_'+id+']').val(width*10);
				$('#mastertimer-curtimeinner').html(width*10 + 'ms');
				$('#mastertimer-curtime').css('left',width + 'px');
			},
		});
		$('.toogle').click(function(e){
			$('.wrap-slider').toggle(200);
		});
	main_layer = $('#id_layer').val();
	if (main_layer != '')
		$('#caption_'+main_layer).trigger('click');
	// drawRuler();
    activeCommonStyle();
	//mobile style

	$('.data-x').keyup(function (e) {
		currentId = getId(this, true);
		var s_width = $('.slide').width();
		var l_width = $('#caption_' + currentId).width();
		x_center = (s_width / 2) - (l_width / 2);
		x_current = $(this).val();
		if (x_current == 'center') {
			$('#caption_' + currentId).css({
				'left' : x_center + 'px'
			});
			$(this).val(Math.round(x_center));
		} else {
			$('#caption_' + currentId).css({
				'left' : x_current + 'px'
			});
			setCoordinates(x_current, false);
		}
	});
	$('.data-y').keyup(function (e) {
		currentId = getId(this, true);
		var s_height = $('.slide').height();
		var l_height = $('#caption_' + currentId).height();
		y_center = (s_height / 2) - (l_height / 2);
		y_current = $(this).val();
		if (y_current == 'center') {
			$('#caption_' + currentId).css({
				'top' : y_center + 'px'
			});
			$(this).val(Math.round(y_center));
		} else {
			$('#caption_' + currentId).css({
				'top' : y_current + 'px'
			});
			setCoordinates(false, y_current);
		}
	});
	function getId(element, name) {
		if (name != undefined)
			strId = $(element).attr('name');
		else
			strId = $(element).attr('id');
		if (strId == undefined) return undefined;
	    return strId.match(patt1);
	}
	function setPosition() {
		if (style=='mobile') {
			var top = 'data_my_';
			var left = 'data_mx_';
			var width = 'data_mwidth_';
			var height = 'data_mheight_';
		} else if (style=='mobile2'){
			var top = 'data_m2y_';
			var left = 'data_m2x_';
			var width = 'data_m2width_';
			var height = 'data_m2height_';
		} else if (style=='tablet'){
			var top = 'data_ty_';
			var left = 'data_tx_';
			var width = 'data_twidth_';
			var height = 'data_theight_';
		} else {
			var top = 'data_y_';
			var left = 'data_x_';
			var width = 'data_width_';
			var height = 'data_height_';
		}
		$('[id^=caption_').each(function() {
			id = getId(this);
			$(this).css('top' , $('input[name='+top+id+']').val()+'px');
			$(this).css('left', $('input[name='+left+id+']').val()+'px');
            w = Number($('input[name='+width+id+']').val());
            h = Number($('input[name='+height+id+']').val());
            if (w <= 0) {
                w = $(this).width();
                $('input[name='+width+id+']').val($(this).width());
            }
            else
                w += 'px';
            if (h <= 0) {
                h = $(this).height();
                $('input[name='+height+id+']').val($(this).height());
            }
            else
                h += 'px';
            $(this).css('width' , w);
			$(this).css('height', h);
    	})
	}
	function setVisible(mobile) {
		if (style=='mobile') {
			var show = 'data_mshow_';
		} else if(style=='mobile2') {
			var show = 'data_m2show_';
		} else if(style=='tablet') {
			var show = 'data_tshow_';
		} else {
			var show = 'data_show_';
		}
		$('[id^=caption_').each(function() {
			id = getId(this);
			if (parseInt($('input[name='+show+id+']').val())) {
				$('#layer_'+id+' .quick-show').find('i').removeClass('layer-hide');
				$(this).show();
			}
			else {
				$('#layer_'+id+' .quick-show').find('i').addClass('layer-hide');
				$(this).hide();
			}
		})
	}
	function setFont() {
		if (style=='mobile') {
			var fontsize = 'data_mfont_size_';
			var fontweight = 'data_mfont_weight_';
			var fontstyle = 'data_mstyle_';
			var lineheight = 'data_mline_height_';
		} else if (style=='mobile2') {
			var fontsize = 'data_m2font_size_';
			var fontweight = 'data_m2font_weight_';
			var fontstyle = 'data_m2style_';
			var lineheight = 'data_m2line_height_';
		} else if (style=='tablet') {
			var fontsize = 'data_tfont_size_';
			var fontweight = 'data_tfont_weight_';
			var fontstyle = 'data_tstyle_';
			var lineheight = 'data_tline_height_';
		} else {
			var fontsize = 'data_font_size_';
			var fontweight = 'data_tfont_weight_';
			var fontstyle = 'data_tstyle_';
			var lineheight = 'data_line_height_';
		}
		$('[id^=caption_').each(function() {
			id = getId(this);
			$(this).css('font-size' , $('input[name='+fontsize+id+']').val()+'px');
			$(this).css('font-weight' , $('input[name='+fontweight+id+']').val()+'px');
			$(this).css('font-style', $('select[name='+fontstyle+id+']').val());
			$(this).css('line-height', $('input[name='+lineheight+id+']').val()+'px');
		})
	}
	function selectFirstLayer() {
		$('#frame_layer .layer').first().trigger('click');
	}
    function activeMobileStyle() {
    	if (style=='mobile')
    		return;
    	$('.defaultOpen').click();
    	$('.tab-desktop').hide();
    	$('.tab-tablet').hide();
    	$('.tab-mobile2').hide();
    	$('.tab-mobile').show();
        w = $('.slider').width();
        if (w > 480) {
        	style = 'mobile';
        	$('#layer-tools .btn').removeClass('btn-active');
        	$('.mobile-style').addClass('btn-active');
            mheight = $('#mobile_height').val();
            $('.slider').width(480);
            $('.slider').height(mheight);
        	drawRuler();
        	setPosition();
        	setFont();
        	setVisible();
        	selectFirstLayer();
        }
    }
    function activeMobile2Style() {
    	if (style == 'mobile2')
    		return;
    	$('.defaultOpen').click();
    	$('.tab-desktop').hide();
    	$('.tab-tablet').hide();
    	$('.tab-mobile').hide();
    	$('.tab-mobile2').show();
        w = $('.slider').width();
        style = 'mobile2';
        $('#layer-tools .btn').removeClass('btn-active');
    	$('.mobile2-style').addClass('btn-active');
        mheight = $('#mobile_height').val();
        $('.slider').width(768);
        $('.slider').height($('#mobile2_height').val());
    	drawRuler();
    	setPosition();
    	setFont();
    	setVisible();
    	selectFirstLayer();
    }
    function activeTabletStyle() {
    	if (style=='tablet')
    		return;
    	$('.defaultOpen').click();
    	$('.tab-desktop').hide();
    	$('.tab-mobile').hide();
    	$('.tab-mobile2').hide();
    	$('.tab-tablet').show();
        w = $('.slider').width();
        	style = 'tablet';
        	$('#layer-tools .btn').removeClass('btn-active');
        	$('.tablet-style').addClass('btn-active');
            mheight = $('#mobile_height').val();
            $('.slider').width(1200);
            $('.slider').height($('#tablet_height').val());
        	drawRuler();
        	setPosition();
        	setFont();
        	setVisible();
        	selectFirstLayer();
    }
    function activeCommonStyle() {
        console.log('alo');
    	if (style ==' desktop')
    		return;
    	$('.defaultOpen').click();
    	style = 'desktop';
    	$('.tab-desktop').show();
    	$('.tab-mobile').hide();
    	$('.tab-mobile2').hide();
    	$('.tab-tablet').hide();
        	$('#layer-tools .btn').removeClass('btn-active');
        	$('.desktop-style').addClass('btn-active');
        $('.slider').width($('#slider_width').val());
        $('.slider').height($('#slider_height').val());
    	drawRuler();
    	setPosition();
    	setFont();
    	setVisible();
    	selectFirstLayer();
    }
    $('.mobile2-style').click(activeMobile2Style);
    $('.mobile-style').click(activeMobileStyle);
    $('.desktop-style').click(activeCommonStyle);
    $('.tablet-style').click(activeTabletStyle);

    $(window).bind('resize', function() {
        drawRuler();
    	// selectFirstLayer();
    });

});