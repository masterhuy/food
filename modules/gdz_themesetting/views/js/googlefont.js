/*
 * jQuery.fontselect - A font selector for the Google Web Fonts api
 * Tom Moor, http://tommoor.com
 * Copyright (c) 2011 Tom Moor
 * MIT Licensed
 * @version 0.1
*/

// google fonts
jQuery(document).ready(function($){
  $(document).on('click','li .font-weight-popup', function(e) {
      e.stopPropagation();
  })
  $(document).on('click','li .font-container', function(e) {
      $('.font-weight-popup').appendTo($(this));
  })
  $(document).on('click','ul.g-fonts li', function(e) {
      $('.g-fonts > li').removeClass('font-active')
      $(this).addClass('font-active');
  })
  $(document).on('click','.font-styles', function(e) {
      var styles = $(this).closest('.g-font-item').attr('data-styles');
      inputData = $('.google-fonts-json').val() ? JSON.parse($('.google-fonts-json').val()) : {};
      var dataWeight = "",
      nameFont = $(this).closest('.g-font-item').attr('data-name');
      if($(this).closest('.g-font-item').hasClass('font-active')){
          dataWeight = inputData[nameFont].weight;
      }
      console.log(styles);
      fontWeightRenderPopup($('.font-weight-popup'), styles, dataWeight);
      $('.font-weight-popup').show();
  })
  var fontWeight_NumbertoText = function ($number) {
      var text = '';
      switch ($number) {
          case '100':
              text = 'Thin';
              break;
          case '100italic':
          case '100i':
              text = 'Thin italic';
              break;
          case '200':
              text = 'Extra-Light';
              break;
          case '200italic':
          case '200i':
              text = 'Extra-Light italic';
              break;
          case '300':
              text = 'Light';
              break;
          case '300italic':
          case '300i':
              text = 'Light italic';
              break;
          case '400':
          case 'regular':
              text = 'Regular';
              break;
          case 'italic':
          case '400italic':
          case '400i':
              text = 'Regular italic';
              break;
          case '500':
              text = 'Medium';
              break;
          case '500italic':
          case '500i':
              text = 'Medium italic';
              break;
          case '600':
              text = 'Semi-Bold';
              break;
          case '600italic':
          case '600i':
              text = 'Semi-Bold italic';
              break;
          case '700':
              text = 'Bold';
              break;
          case '700italic':
          case '700i':
              text = 'Bold italic';
              break;
          case '800':
              text = 'Extra-Bold';
              break;
          case '800italic':
          case '800i':
              text = 'Extra-Bold italic';
              break;
          case '900':
              text = 'Ultra-Bold';
              break;
          case '900italic':
          case '900i':
              text = 'Ultra-Bold italic';
              break;
          default:
              text = $number;
              break;
      }
      return text;
  }
  var fontWeight_TexttoNumber = function ($text) {
      var number = '';
      switch ($text) {
          case 'Thin':
              number = 100;
              break;
          case '100italic':
          case '100 italic':
          case 'Thin italic':
              number = '100i';
              break;
          case 'Extra-Light':
              number = 200;
              break;
          case '200italic':
          case '200 italic':
          case 'Extra-Light italic':
              number = '200i';
              break;
          case 'Light':
              number = 300;
              break;
          case '300italic':
          case '300 italic':
          case 'Light italic':
              number = '300i';
              break;
          case 'Regular':
          case 'regular':
              number = 400;
              break;
          case '400 italic':
          case 'italic':
          case 'Regular italic':
              number = '400i';
              break;
          case 'Medium':
              number = 500;
              break;
          case '500italic':
          case 'Medium italic':
              number = '500i';
              break;
          case 'Semi-Bold':
              number = 600;
              break;
          case '600italic':
          case 'Semi-Bold italic':
              number = '600i';
              break;
          case 'Bold':
              number = 700;
              break;
          case '700italic':
          case 'Bold italic':
              number = '700i';
              break;
          case 'Extra-Bold':
              number = 800;
              break;
          case '800italic':
          case 'Extra-Bold italic':
              number = '800i';
              break;
          case 'Ultra-Bold':
              number = 900;
              break;
          case '900italic':
          case 'Ultra-Bold italic':
              number = '900i';
              break;

          default:
              number = $text;
              break;
      }
      return number;
  }
  var fontWeightRenderPopup = function($selector, $styles, dataW) {
      var $div = "";
      //convert data to array
      var weightArr = $styles.split(",");
      if(weightArr.length){
          if(dataW && typeof dataW == 'string') dataW = JSON.parse(dataW);
          $div += "<ul>";
          weightArr.forEach(function(w){
              w = fontWeight_NumbertoText(w);
              w_number = fontWeight_TexttoNumber(w);
              var $checked = "";
              if(dataW.includes(w_number.toString())){
                  $checked = 'checked=""';
              }
              $div += "<li class='form-checkbox'>";
              $div += "<label class='checkbox-label'>";
              $div += '<input type="checkbox" class="form-check-input" value="" data-value="'+w_number+'" '+$checked+'>'+w;
              $div += "</label></li>";
          });
          $div += "</ul>";
      }
      if($div){
          $div += '<div class="btn-actions"><button  type="button"data-action="btn.cancel" class="btn-action">Cancel</button>';
          $div += '<button type="button" data-action="btn.selected" class="btn-action btn-primary">Select font</button></div>';
      }
      $selector.html($div);
  }
  $(document).on('click','.btn-action[data-action="btn.selected"]', function(e) {
      var dataWeight = [];
      var nameFont = $(this).closest('.g-font-item').attr('data-name'),fontObj = {};
      var fontInputs = $('.google-fonts-json').val() ? JSON.parse($('.google-fonts-json').val()) : {};
      $('.form-checkbox').find('.form-check-input').each(function(){
          if($(this).prop('checked')){
              dataWeight.push($(this).data('value').toString());
          }
      });
      $(this).closest('.g-font-item').addClass('font-active');
      fontObj.name = nameFont;
      fontObj.weight = dataWeight;
      $(".font-weight-popup").hide();
      if(!fontInputs[nameFont]){
          var $li = '<li data-name="'+nameFont+'"><div class="font-selected"><span class="font-name selected-name" style="font-family:'+nameFont+'">'+nameFont+'</span><span class="font-styles">'+dataWeight.join(',')+'</span></div><span class="icon icon-close font-deleted"></span></li>'
          $('.g-fonts-selected > ul').append($li);
       }
      fontInputs[nameFont] = fontObj;
      updateHead(JSON.stringify(fontInputs));
      $('.google-fonts-json').val(JSON.stringify(fontInputs)).trigger('change');
  });
  var updateHead = function (data){
      let nameFonts = Object.values(JSON.parse(data)),fontname = [];
      nameFonts.forEach(function(font){
          let fontval = font.name;
          if(font.weight.length) fontval += ":"+font.weight.join(',');
          fontname.push(fontval);
      });
      $('head').find('.loadfonts').remove();
      $('<link class="loadfonts" href="https://fonts.googleapis.com/css?family='+escape(fontname.join('|'))+'" rel="stylesheet" type="text/css" />').appendTo($('head'));
  }
  $(document).on('click','span.font-deleted',function(){
      var namefont = $(this).parents('li').attr('data-name');
      var inputData = $('.google-fonts-json').val() ? JSON.parse($('.google-fonts-json').val()) : [];
      delete inputData[namefont];
      $('.google-fonts-json').val(JSON.stringify(inputData)).trigger('change');
      $(this).parents('li').remove();
  });
  $(document).on('keyup','#font-filter',function() {
      var value = $(this).val().toLowerCase();
      var fontCount = 0;
      var $filterKey = 'li.g-font-item', $filterView = $('.fonts-search');
      $('li.g-font-item').filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
          if($(this).text().toLowerCase().indexOf(value) > -1){
            fontCount++;
          }
      });
  });
  $(document).on('click','.btn-action[data-action="csss.save"]', function() {
      var inputData = $('.custom-font-css').val() ? JSON.parse($('.custom-font-css').val()) : [];
      var new_css_urls = $('#custom-css').val();
      var url_arr = new_css_urls.split("\n");
      url_arr.forEach(function(url, index){
          url = url.trim();
          if(url) {
              var $li = '<li data-url="'+url+'"><div class="font-css-selected"><span class="css-url selected-name">'+url+'</span></div><span class="icon icon-close css-deleted"></span></li>'
              $('.custom-css-selected > ul').append($li);
              inputData.push(url);
          }
      });
      $('.custom-font-css').val(JSON.stringify(inputData));
  });
  $(document).on('click','span.css-deleted',function(){
      var url = $(this).parents('li').attr('data-url');
      var inputData = $('.custom-font-css').val() ? JSON.parse($('.custom-font-css').val()) : [];
      var url_arr = [];
      $(this).parents('li').remove();
      $('.custom-css-selected li').each(function(){
        url_arr.push($(this).attr('data-url'));
      });
      $('.custom-font-css').val(JSON.stringify(url_arr));
  });
  $(document).on('click','.btn-action[data-action="files.save"]', function() {
      var inputData = $('.custom-file-url').val() ? JSON.parse($('.custom-file-url').val()) : [];
      console.log(inputData);
      var new_file_urls = $('#custom-file').val();
      var url_arr = new_file_urls.split("\n");
      url_arr.forEach(function(url, index){
          url = url.trim();
          if(url) {
              var $li = '<li data-url="'+url+'"><div class="font-file-selected"><span class="file-url selected-name">'+url+'</span></div><span class="icon icon-close file-deleted"></span></li>'
              $('.custom-file-selected > ul').append($li);
              inputData.push(url);
          }
      });
      console.log(inputData);
      $('.custom-file-url').val(JSON.stringify(inputData));
  });
  $(document).on('click','span.file-deleted',function(){
      var url = $(this).parents('li').attr('data-url');
      var inputData = $('.custom-file-url').val() ? JSON.parse($('.custom-file-url').val()) : {};
      var url_arr = [];
      $(this).parents('li').remove();
      $('.custom-file-selected li').each(function(){
        url_arr.push($(this).attr('data-url'));
      });
      $('.custom-file-url').val(JSON.stringify(url_arr));
  });
  //init google fonts
  var head = '';
  let googlfonts = inputData = $('.google-fonts-json').val() ? JSON.parse($('.google-fonts-json').val()) : {};
  let fontArr = Object.values(googlfonts),fontname = [];
  fontArr.forEach(function(font){
      let fontval = font.name;
      if(font.weight.length) fontval += ":"+font.weight.join(',');
      fontname.push(fontval);
    });
    $('<link class="loadfonts" href="https://fonts.googleapis.com/css?family='+escape(fontname.join('|'))+'" rel="stylesheet" type="text/css" />').appendTo($('head'));
});
