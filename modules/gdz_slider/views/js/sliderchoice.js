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
    $(".chosen-select").chosen({
        width: "50%"
    });
    $('.displaylist').on('click', '.add-hook', function () {
        slider = $(this).attr('data-slider');
        val = $('#select_'+slider).val();
        if (val == null) {
            alert('empty selection');
            return;
        }
        url = $('#site_url').val() + '/modules/gdz_slider/ajax_sliderchoice.php?addHook';
        $.ajax({
            type : "POST",
            url : url,
            data : {
                hooks: val,
                id_slider: slider,
                secure_key: secure_key,
            },
            success : function (result) {
                data = JSON.parse(result);
                console.log(data);
                jQuery.each(data, function(hook, result) {
                    if (result) {
                        option = $('#select_'+slider).find('option[value='+hook+']');
                    console.log(option);
                        text = option.html();
                        option.remove();
                        $('#select_'+slider).trigger("chosen:updated");
                        $('#list_hook_'+slider).append('<li data-hook="'+hook+'"><span>'+text+'</span><i class="icon-remove deleteHook"></i></li>');
                    }
                })
                console.log(result);
            },
            error : function () {
                alert('Error401');
            },
            dataType : 'html'
        });
    })
    $('.displaylist').on('click' , '.deleteHook', function () {
        slider = $(this).closest('ul').attr('data-slider');
        hook = $(this).parent().attr('data-hook');
        item = $(this).parent();
        url = $('#site_url').val() + '/modules/gdz_slider/ajax_sliderchoice.php?deleteHook';
        $.ajax({
            type : "POST",
            url : url,
            data : {
                hook: hook,
                id_slider: slider,
                secure_key: secure_key,
            },
            success : function (result) {
                data = JSON.parse(result);
                if (data.result) {
                    text = item.find('span').html();
                    item.remove();
                    $('#select_'+slider).append('<option value="'+hook+'">'+text+'</option>');
                    $('#select_'+slider).trigger("chosen:updated");
                    console.log($('#list_hook_'+slider+' li').size());
                    if ($('#list_hook_'+slider+' li').size() == 0) {
                        $('#select-slider').append('<option value="'+slider+'">'+$('#slider_title_'+slider).html()+'</option>');
                        $('#select-slider').trigger("chosen:updated");
                        $('#display_'+slider).remove();
                    }
                }
            },
            error : function () {
                alert('Error401');
            },
            dataType : 'html'
        });
    })
    $('.addDisplay').click(function () {
        val = $('#select-slider').val();
        if (val == null) {
            alert('empty selection');
            return;
        }
        url = $('#site_url').val() + '/modules/gdz_slider/ajax_sliderchoice.php?addDisplay';
        $.ajax({
            type : "POST",
            url : url,
            data : {
                secure_key: secure_key,
                sliders: val
            },
            success : function (result) {
                data = JSON.parse(result);
                jQuery.each(data, function(k, value) {
                    if (value.result) {
                        $('.displaylist').append(value.html);
                        $("#select_"+value.slider).chosen({
                            width: "50%"
                        });
                        console.log('option[value='+value.slider+']');
                        $('#select-slider').find('option[value='+value.slider+']').remove();
                        $('#select-slider').trigger("chosen:updated");
                    }
                })
            },
            error : function () {
                alert('Error401');
            },
            dataType : 'html'
        });
    })
    $('.displaylist').on('click' , '.deleteDisplay', function () {
        slider = $(this).attr('data-slider');
        url = $('#site_url').val() + '/modules/gdz_slider/ajax_sliderchoice.php?deleteDisplay';
        $.ajax({
            type : "POST",
            url : url,
            data : {
                secure_key: secure_key,
                id_slider: slider
            },
            success : function (result) {
                data = JSON.parse(result);
                if (data.result) {
                    $('#select-slider').append('<option value="'+slider+'">'+$('#slider_title_'+slider).html()+'</option>');
                    $('#select-slider').trigger("chosen:updated");
                    $('#display_'+slider).remove();
                }
            },
            error : function () {
                alert('Error401');
            },
            dataType : 'html'
        });
    })
})
