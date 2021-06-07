{**
* 2007-2020 PrestaShop
*
* Godzilla Slider
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*}
<script type="text/javascript">
            $(function() {
                var $mySlides = $("#slides");
                $mySlides.sortable({
                    opacity: 0.6,
                    cursor: "move",
                    update: function() {
                        var order = $(this).sortable("serialize") + "&action=updateSlidesOrdering&secure_key="+secure_key;
                        $.post("{$root_url nofilter}modules/gdz_slider/ajax_gdz_slider.php?" + order);
                        }
                    });
                $mySlides.hover(function() {
                    $(this).css("cursor","move");
                    },
                    function() {
                    $(this).css("cursor","auto");
                });
            });
</script>
<div class="panel">
    <h3>
    <span title="" data-toggle="tooltip" class="label-tooltip toogle" data-original-title="Click to Toggle" data-html="true">
        <i class="icon-list-ul"></i> {l s='Slides list' mod='gdz_slider'}
    </span>
    </h3>
    <script>
    $(document).ready(function(){
        $('.toogle').click(function(e){
            $('#slidesContent').toggle(200);
        });
    });

    </script>
    <div id="slidesContent">
        <div id="slides">
            {foreach from=$slides item=slide}
            <div id="slides_{$slide->id}" class="panel" style="{if $slide->bg_type}background-image: url('{$img_dir}slides/{$slide->bg_image}');{else}background-color: {$slide->bg_color} {/if}">
                <div class="title">
                    <span class="slider-name">#{$slide->id}-{$slide->title}</span>
                    <div class="button">
                        <a href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&editSlide=1&id_slide={$slide->id}"><i title="edit" class="material-icons action">mode_edit</i></a>
                        <a onclick="if(confirm('Are you sure want to remove this slide?')) { document.location='{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&delete_id_slide={$slide->id}'; } else { return true;}" ><i title="delete" class="material-icons action">delete</i></a>
                        <a href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&copySlide=1&id_slide={$slide->id}"><i title="duplicate" class="icon-copy action"></i></a>
                        <a href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&changeStatus&id_slide={$slide->id}"><i title="{if $slide->status}enable{else}disable{/if}" class="icon-{if $slide->status}check{else}remove{/if}"></i></a>
                    </div>


                </div>
            </div>
            {/foreach}
            <a href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&addSlide&id_slider={$slider->id}" title="{l s='Add Slide' mod='gdz_slider'}">
                <div class="panel" style="background-image: url('{$img_dir}settings/new_slider.png');background-size: unset;">
                    <div class="title">
                        <span>New Slide</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>