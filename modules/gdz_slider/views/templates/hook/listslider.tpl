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
                var $myslider = $("#slider");
                $myslider.sortable({
                    opacity: 0.6,
                    cursor: "move",
                    update: function() {
                        var order = $(this).sortable("serialize") + "&action=updateSliderOrdering&secure_key="+secure_key;
                        $.post("{$root_url nofilter}modules/gdz_slider/ajax_gdz_slider.php?" + order);
                        }
                    });
                $myslider.hover(function() {
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
        <i class="icon-list-ul"></i> {l s='slider list' mod='gdz_slider'}
    </span>

    <span class="panel-heading-action">
        <a  href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&addSlider" class="btn btn-default btn-success" id="addSlide" title="{l s='Add Slider' mod='gdz_slider'}">
            <i class="icon-plus"></i>
        </a>

    </span>
    </h3>
    <script>
    $(document).ready(function(){
        $('.toogle').click(function(e){
            $('#sliderContent').toggle(200);
        });
    });

    </script>
    <div id="sliderContent">
        <div id="slider">
            {if $sliders|@count gt 0}
            {foreach from=$sliders item=slider}
            <div id="slider_{$slider->id_slider}" class="panel">
                <div class="row">
                    <div class="col-lg-1">
                        <span><i class="icon-arrows "></i></span>
                    </div>
                    <div class="col-md-2">
                        #{$slider->id_slider} - {$slider->title}
                    </div>
                    <div class="col-md-9">
                        <div class="btn-group-action pull-right">
                            <a class="btn btn-default" href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&copySlider&id_slider={$slider->id_slider}">
                                <i class="icon-copy"></i>
                                {l s='Duplicate' mod='gdz_slider'}
                            </a>
                            <a class="btn {if $slider->active}btn-success{else}btn-danger{/if}"
                                href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&changeSliderStatus&id_slider={$slider->id_slider}" title="{if $slider->active}Enabled{else}Disabled{/if}">
                                <i class="{if $slider->active}icon-check{else}icon-remove{/if}"></i>{if $slider->active}Enabled{else}Disabled{/if}
                            </a>
                            <a class="btn btn-default"
                                href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&editSlider&id_slider={$slider->id_slider nofilter}">
                                <i class="icon-edit"></i>
                                {l s='Edit' mod='gdz_slider'}
                            </a>
                            <a class="btn btn-default" onclick="if(confirm('Are you sure want to remove this slide?')) { document.location='{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&delete_id_slider={$slider->id_slider}'; } else { return true;}"
                                >
                                <i class="icon-trash"></i>
                                {l s='Delete' mod='gdz_slider'}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            {/foreach}
            {else}
            {l s='There is no slider' mod='gdz_slider'}
            {/if}
        </div>
    </div>
</div>