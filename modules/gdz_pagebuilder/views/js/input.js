$(document).ready(function() {    
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
                if (ConditionCheck(this.value, conditionValue, conditionOperator)) {
                    $field.addClass('show-setting');
                } else {
                    $field.removeClass('show-setting');
                }
            });
        });
    });
    $(document).on('click','.input-align li',function(event) {
        $('.input-align li').removeClass('active');
        $(this).addClass('active');
        $(this).parent().next().val($(this).attr('data-align'));
        $(this).parent().next().trigger('change');
  	});
    /// Image + Images
    var timer;
    $(document).on('click', '.repeat-input .add-item', function() {
        fid = genID();
        images_input = $(this).closest('.repeat-input');
        form_group = images_input.find('.form-group.hidden').clone().removeClass('hidden');
        container = images_input.find('.items-container');
        form_group.find('input[name=image]').attr('id', 'media-value-' + fid);
        form_group.find('.media-image-preview').attr('id', 'media-preview-' + fid);
        select = form_group.find('.media-upload');
        select.attr('data-url', select.attr('data-url')+'&fid='+fid);
        container.append(form_group);
        images_input.trigger('change');
        //reLoadUI();
    })
    $(document).on('change keyup', '.repeat-input input, .repeat-input textarea', function(e) {
        images_input = $(this).closest('.repeat-input');
        if (e.type == 'keyup') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                images_input.trigger('change');
            }, 500);
        } else {
            images_input.trigger('change');
        }
    })
    $(document).on('click', '.repeat-input .remove-media', function() {
        images_input = $(this).closest('.repeat-input');
        input = $(this).closest('.form-group');
        input.remove();
        images_input.trigger('change');
    })
    //show/hide item fields
    $(document).on('click','.item-tools',function(event) {
        var items_container = $(this).closest('.items-container');
        if($(this).parent().find('.item-row-fields').hasClass('show')) {
          items_container.find('.item-row-fields').removeClass('show');
        } else {
          items_container.find('.item-row-fields').removeClass('show');
          $(this).parent().find('.item-row-fields').addClass('show');
        }
    });
    //duplicate item row
    $(document).on('click', '.item-row-duplicate', function(event) {
        event.preventDefault();
        event.stopPropagation();
        fid = genID();
        form_group = $(this).closest('.form-group');
        var $clone = form_group.clone();
        $clone.find('input[name=image]').attr('id', 'media-value-'+fid);
        $clone.find('.media-image-preview').attr('id', 'media-preview-'+fid);
        select = $clone.find('.media-upload');
        select.attr('data-url', select.attr('data-url')+'&fid='+fid);
        $clone.insertAfter(form_group);
        $(this).closest('.repeat-input').trigger('change');
    })

    $(document).on('click', '.media-image-delete', function(event) {
        event.preventDefault();
        event.stopPropagation();
        $(this).parent().next().val('').trigger('change');
        $(this).parent().find('.media-image-preview').css('background-image','');
        $(this).parent().addClass('media-empty');
    })
    $(document).on('change keyup', '.input-media', function() {
        if($(this).val()) {
          $(this).prev().find('.media-image-preview').css('background-image','url(' + $(this).val() + ')');
          $(this).prev().removeClass('media-empty');
        } else {
            $(this).prev().find('.media-image-preview').css('background-image','');
            $(this).prev().addClass('media-empty');
        }
    })
    $(document).on('change keyup', '.repeat-item-title', function() {
        $(this).closest('.form-group').find('.item-tools .item-row-title').html($(this).val());
    })

    //Range
    $(document).on('change', '.pb-range', function() {
        $(this).next().val($(this).val());
        $(this).next().trigger('change');
    })
    $(document).on('change keyup', '.pb-range-input input[type=number]', function() {
        $(this).prev().val($(this).val());
    })
    $('.pb-range').each(function(){
        $(this).val($(this).next().val());
    })
    $(document).on('click', '.pb-device-tabs li', function() {
        var device_class = '';
        if($(this).find('.icon-sm').length > 0) {
          device_class = 'sm';
        } else if($(this).find('.icon-xs').length > 0) {
          device_class = 'xs';
        } else {
          device_class = 'md';
        }
        var tab_class = 'pb-device-' + device_class;
        $(this).parent().removeClass('pb-device-md pb-device-sm pb-device-xs');
        $(this).parent().addClass(tab_class);
        $(this).parent().next().removeClass('pb-device-md pb-device-sm pb-device-xs');
        $(this).parent().next().addClass(tab_class);
        $('.device-icons li.li-' + device_class).trigger('click');

    })
    $(document).on('change keyup', '.pb-screen-inputs input[type=number]', function() {
        var val_arr = [];
        $(this).closest('.pb-screen-inputs').find('input[type=number]').each(function(){
            val_arr.push($(this).val());
        })
        $(this).closest('.pb-screen-inputs').next().val(val_arr.join('-'));
        $(this).closest('.pb-screen-inputs').next().trigger('change');
    })
    $(document).on('change keyup', '.pb-screen-inputs .pb-range', function() {
        $(this).val($(this).next().val());
        var val_arr = [];
        $(this).closest('.pb-screen-inputs').find('input[type=number]').each(function(){
            val_arr.push($(this).val());
        })
        $(this).closest('.pb-screen-inputs').next().val(val_arr.join('-'));
        $(this).closest('.pb-screen-inputs').next().trigger('change');
    })
    $(document).on('change', '.pb-screen-inputs select', function() {
        var val_arr = [];
        $(this).closest('.pb-screen-inputs').find('select').each(function(){
            val_arr.push($(this).val());
        })
        $(this).closest('.pb-screen-inputs').next().val(val_arr.join('-'));
        $(this).closest('.pb-screen-inputs').next().trigger('change');
    })
    $(document).on('change keyup', '.pb-screen-inputs input[type=text]', function() {
        wrap = $(this).closest('.form-group');
        md = wrap.find('.md').find('input').val();
        sm = wrap.find('.sm').find('input').val();
        xs = wrap.find('.xs').find('input').val();
        val = `${md}-${sm}-${xs}`;
        wrap.find('.addon-input').val(val).trigger('change');
    })
    //
    switchDialogForm = function (form) {
        if(form == 'library') {
              $.ajax({
                  type: 'POST',
                  url: PagebuilderConfig.editor_link + '&action=GetTemplates&ajax=1',
                  success: function(data)
                  {
                      $('#pagebuilder-library-template-form').find('#pagebuilder-template-list').html(data);
                  }
              });
        }
        $('.pagebuilder-template-form').hide();
        $('#pagebuilder-' + form + '-template-form').show();
        $('.pagebuilder-dialog-switch-form').removeClass('active');
        $('.pagebuilder-dialog-switch-' + form).addClass('active');
    }
    $(document).on('click', '.dialog-open', function(event){
        var _dialog = $('#pagebuilder-' + $(this).attr('data-dialog'));
        _dialog.data('row-id', '');
        var _left = ($(window).width() - _dialog.find('.pagebuilder-dialog-content').width())/2;
        _dialog.find('.pagebuilder-dialog-content').css('left', _left + 'px');
        _dialog.show();
        switchDialogForm($(this).attr('data-form'));
    });
    $(document).on('click', '.pagebuilder-dialog-close', function(event){
        $(this).closest('.pagebuilder-dialog').hide();
    });
    $(document).on('click', '.pagebuilder-dialog-switch-form', function(event){
        switchDialogForm($(this).attr('data-form'));
    });

    $(document).on('click', '#library-load-template', function(event){
        event.preventDefault();
        event.stopPropagation();
        var templatename = $('#library-load-template-name').val();
        if(templatename == '') {
            alert('Please enter template name');
            return;
        }
        var myUploadedFile = document.getElementById("library-template-file").files[0];
        var reader = new FileReader();
        reader.onload = function(){
          var text = reader.result;
          $.ajax({
              type: 'POST',
              url: PagebuilderConfig.editor_link + '&action=SaveTemplate&ajax=1',
              data: {
                  jsonparams: text,
                  templatename: templatename,
              },
              success: function(data)
              {
                  switchDialogForm('library');
              }
          });
        };
        reader.readAsText(myUploadedFile);
    });
    $(document).on('click', '.template-delete', function(event){
        if ( confirm("Click Ok button to delete this Template, Cancel to leave.") == true ) {
            var template_row = $(this).closest('.template-row');
            $.ajax({
                type: 'POST',
                url: PagebuilderConfig.editor_link + '&action=DeleteTemplate&ajax=1',
                data: {
                    id_template: template_row.attr('data-id')
                },
                success: function(data)
                {
                    template_row.remove();
                }
            });
        }

    });
    $(document).on('click', '.template-export', function(event){
        event.preventDefault();
        event.stopPropagation();
        var template_row = $(this).closest('.template-row');
        var export_link = PagebuilderConfig.editor_link + '&action=ExportTemplate&ajax=1&id_template=' + template_row.attr('data-id');
        anchor = document.createElement('a');

        anchor.download = template_row.find('template-name').html() + '.json';
        anchor.href = export_link;
        anchor.dataset.downloadurl = ['text/plain', anchor.download, anchor.href].join(':');
        anchor.click();

    });


})
