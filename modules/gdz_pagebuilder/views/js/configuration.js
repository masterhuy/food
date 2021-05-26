$(document).ready(function() {
    var timer;
    $('#gdz-configuration').on('change keyup', '.use-editor-js [data-field]', function(e) {
        if (e.target !== this)
            return;
        component = $('#gdz-configuration').data('component');
        addonName = component.attr('data-name');
        field = $(this).attr('data-field');

        if (e.type == 'keyup') {
            clearTimeout(timer);
            timer = setTimeout(function () {
                $(e.target).trigger('change');
            }, 200);
            return;
        }
        setting = $('#gdz-configuration').data('setting');
        index = _.findKey(setting, {'name': field});
        let value = $(this).getInputValue();
        if (setting[index]['multilang'] == '1') {
          let lang = $(this).attr('data-lang');
          if (lang == undefined)
            lang = default_language;
          setting[index]['value'][lang] = value;
        } else {
            setting[index]['value'] = value;
        }
        updateComponent(component, setting);
        if(field == 'expire_time') {
            component.find('.countdown').each(function( key, value ) {
              var $expire_time = $(this).html();
              var _datetime = $expire_time.split(" ");
              var _date = _datetime[0];
              var _time = _datetime[1];
              var datestr = _date.split("-");
              var timestr = _time.split(":");
              var austDay = new Date(datestr[0], datestr[1]-1, datestr[2], timestr[0], timestr[1], timestr[2], 0);
              $(this).countdown({until: austDay});
            });
        }
    })
})
