document.addEventListener("DOMContentLoaded", function (event) {
    $(document).ready(function () {
        AddPageCmsButton = (function () {
            var $btnTemplate = $('#tmpl-btn-add-page-cms');
            var $cmsPageContent =  $("#cms_page_content");
            function init() {
                $cmsPageContent.prepend($btnTemplate.html());
            }
            return {init: init};
        })();
        AddPageCmsButton.init();
    });
    $(document).on('click','.add-page',function(event) {
        if($('#page_id').val()) {
            var shortcode = '[gdz_pagebuilder page_id=' +  $('#page_id').val() + ']';
            tinymce.activeEditor.execCommand('mceInsertContent', false, shortcode);
        }
        return;
    });
});
