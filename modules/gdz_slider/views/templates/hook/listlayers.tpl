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

<form id="layer_form" action="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&layer=1" method="post">
<div class="panel area-display">
	<h3>
	<span title="" data-toggle="tooltip" class="label-tooltip toogle" data-original-title="Click to Toggle" data-html="true">
		<i class="icon-list-ul"></i> {l s='Layers list of' mod='gdz_slider'}
	</span>
	</h3>
	<div class="list-title-slides">
    {foreach $slider->slides as $slide}
        <a {if $slide->id==$currentSlide->id}class="btn-info"{else}title="{l s='Click here go to ' mod='gdz_slider'}{$slide->title}"{/if} href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider&editSlide&id_slide={$slide->id}">{$slide->title}</a>&nbsp;&nbsp;
    {/foreach}
    </div>
	{include './layer-tool.tpl'}
	{foreach $currentSlide->layers as $layer}
		{include './layerconfig.tpl' layer=$layer}
	{/foreach}
	<div class="panel-body ">
		<div class="wrap-slider">
			<div id="horlinie"><div id="horlinetext">0</div></div>
			<div id="verlinie"><div id="verlinetext">0</div></div>
			<div id="hor-css-linear"><ul class="linear-texts"></ul></div>
			<div id="ver-css-linear"><ul class="linear-texts"></ul></div>
			<div class="layer-wrapper">
				<div  class="slider" style="width:{$slider->max_width}px;height:{$slider->max_height}px">
					<div id="frame_layer" class="slide" style="{if $currentSlide->bg_type==1}background-image:url({$root_url nofilter}modules/gdz_slider/views/img/slides/{$currentSlide->bg_image nofilter});{else}background-color:{$currentSlide->bg_color nofilter}{/if};background-size:100% 100%;position:relative;width:100%;height:100%">
						{foreach from=$currentSlide->layers item=layer}
							{math assign="data_x" equation='(x/y)*100' x=$layer->desktop->data_x y=$slider->max_width}
							{math assign="data_y" equation='(w/z)*100' w=$layer->desktop->data_y z=$slider->max_height}
							<div id="caption_{$layer->id nofilter}" class="tp-caption layer {$layer->data_class_suffix nofilter}" style="position:absolute; {if $layer->data_video_bg}top:0; left:0;{else}top:{$data_y nofilter}%; left:{$data_x nofilter}%;{/if} font-weight:{$layer->desktop->data_font_weight nofilter};width:{$layer->data_width}px;height:{$layer->data_height}px;font-size:{$layer->desktop->data_font_size nofilter}px; color: {$layer->data_color nofilter}; font-style:{$layer->desktop->data_style nofilter};{if $layer->desktop->data_line_height}line-height:{$layer->desktop->data_line_height nofilter}px;{/if}{if !$layer->desktop->data_show}display:none{/if}">
							{if $layer->data_type=="text"}
								<span>{$layer->data_html nofilter}</span>
							{elseif $layer->data_type=="image"}
								<img width="100%" height="100%" id="image_layer_{$layer->id nofilter}" src="{$root_url nofilter}/modules/gdz_slider/views/img/layers/{$layer->data_image nofilter}">
							{else}
								<i class="icon-arrows move-toolbar" title="Keep mouse to move" ></i>
								{if $layer->videotype == 'youtube'}
								<iframe width="{$layer->data_width nofilter}px;" height="{$layer->data_height nofilter}px;" src="http://www.youtube.com/embed/{$layer->data_video|substr:($layer->data_video|strpos:'?v='+3)}?autoplay={$layer->data_video_autoplay nofilter}&controls={$layer->data_video_controls nofilter}&loop={$layer->data_video_loop nofilter}" allowfullscreen frameborder="0">
								 </iframe>
								 {elseif $layer->videotype == 'vimeo'}
								 {assign var=vimeo_link value = ("/"|explode:$layer->data_video)}
								 <iframe width="{$layer->data_width nofilter}px;" height="{$layer->data_height nofilter}px;" src="https://player.vimeo.com/video/{$vimeo_link[$vimeo_link|count-1]}?autoplay={$layer->data_video_autoplay nofilter}&loop={$layer->data_video_loop nofilter}" allowfullscreen frameborder="0">
								 </iframe>
								 {/if}
							{/if}
							</div>
						{/foreach}
					</div>
				</div> <!-- END SLIDE -->
			</div>
		</div>
		<div class="mastertimer-wrapper">
			<div class="mastertimer-left">
				<ul id="timeline-title">
					<li class="fulltime-title">{l s='Slide Time' mod='gdz_slider'}</li>
						{foreach $currentSlide->layers as $layer}
						<li id="fulltime_title_{$layer->id}" class="fulltime-title"><i class="material-icons">{if $layer->data_type=='text'}assignment{elseif $layer->data_type=='image'}collections{else}video_librarys{/if}</i>{$layer->data_title}</li>
						{/foreach}
				</ul>
			</div>
			<div class="mastertimer-right">
				<div id="mastertimer-curtime"><span id="mastertimer-curtimeinner"></span></div>
				<div class="mastertimer">
					<div id="mastertimer-linear">
						<ul class="linear-texts">
						</ul>
					</div>
				</div>
				<input type="hidden" id="layer_active" value="{if $currentSlide->layers|@count > 0}_{$currentSlide->layers[0]->id}{/if}" />
				<div id="time-line">
					<ul>
						<li id="fulltime" class="mastertimer-slide">
							<div class="fulltime" style="width:{$slider->duration/10}px;"></div>
						</li>
						{foreach $currentSlide->layers as $layer}
						<li id="mastertimer_{$layer->id}" class="mastertimer-layer layer" data-index="0">
							<div class="layer-time ui-widget-content" style="width:{$layer->data_time/10}px">
								<div class="delay-time ui-widget-content" style="width:{$layer->data_delay/10}px">
								</div>
							</div>
						</li>
						{/foreach}
					</ul>
				</div>
			</div>
		</div>

	<div class="panel-footer">
		<button class="btn btn-default pull-right btn-success" name="submitLayer" id="module_form_submit_btn" value="1" type="submit">
			<i class="process-icon-save"></i> {l s='Save' mod='gdz_slider'}
		</button>
		<a class="btn btn-default btn-warning" href="{$link->getAdminLink('AdminModules') nofilter}&configure=gdz_slider" title="{l s='Back to Slides List' mod='gdz_slider'}"><i class="process-icon-back"></i>{l s='Back' mod='gdz_slider'}</a>
	</div>

	<input type="hidden" name="slide_id" id="id_slide" value="{$currentSlide->id nofilter}" />
	<input type="hidden" name="layer_id" id="id_layer" value="{if $currentSlide->layers|@count>0}{$currentSlide->layers[0]->id nofilter}{else}0{/if}" />
	<input type="hidden" name="layer_type" id="type_layer" />
	<input type="hidden" name="site_url" id="site_url" value="{$root_url nofilter}" />
	<input type="hidden" name="id_slide" value="{$currentSlide->id nofilter}">
	<input type="hidden" id="slider_width" value="{$slider->max_width}">
	<input type="hidden" id="slider_height" value="{$slider->max_height}">
	<input type="hidden" id="mobile_height" value="{$slider->mobile_height}">
	<input type="hidden" id="mobile2_height" value="{$slider->mobile2_height}">
	<input type="hidden" id="tablet_height" value="{$slider->tablet_height}">
<div id="modal_add_text" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{l s='Add text or html' mod='gdz_slider'}</h4>
            </div>
            <div class="modal-body">
            	<p>{l s='Title layer' mod='gdz_slider'}</p>
            	<p><input type="text" id="title_text_new" name="title_text_new"></p>
            	<p>{l s='Text or HTML' mod='gdz_slider'}</p>
            	<p><textarea name="data_html" id="text_layer_new" cols="30" rows="10"></textarea></p>
            </div>
        	<p id='loading' class="loading loading-text" style="text-align:center; display:none;"><img  src="{$root_url nofilter}/modules/gdz_slider/views/img/settings/loading.gif" alt="loading"></p>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitLayerText" name="submitLayer">Save</button>
            </div>
        </div>

    </div>
</div>
<div id="modal_add_video" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{l s='Add video (Youtube or Vimeo)' mod='gdz_slider'}</h4>
            </div>
            <div class="modal-body">
            	<p>{l s='Title layer' mod='gdz_slider'}</p>
            	<p><input type="text" id="title_video_new" name="title_video_new"></p>
            	<p>{l s='Video Url' mod='gdz_slider'}</p>
            	<p><textarea name="data_video_new" id="data_video_new" cols="30" rows="3"></textarea></p>
            	<p class="help-block">Eg: https://www.youtube.com/watch?v=2PEG82Udb90 or https://vimeo.com/23259282</p>
            </div>
        	<p id='loading' class="loading loading-text" style="text-align:center; display:none;"><img  src="{$root_url nofilter}/modules/gdz_slider/views/img/settings/loading.gif" alt="loading"></p>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="submitLayerVideo" name="submitLayer">Save</button>
            </div>
        </div>
    </div>
</div> <!-- end modal video -->
<div id="modal_tips" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{l s='TIPS' mod='gdz_slider'}</h4>
            </div>
            <div class="modal-body">
	            <ul style="list-style-type:decimal">
	            	<li class="text-danger">{l s='To set background for slide, click on layer video then set delay = 0, check in box "Set this video for slide background"-->Save' mod='gdz_slider'}</li>
	            	<li  class="text-primary">{l s='To mute video, click on volume video youtube, then click Save' mod='gdz_slider'}</li>
	            	<li  class="text-danger">{l s='Typing "center" in data X or data Y to center align for layer' mod='gdz_slider'}</li>
	            	<li class="text-primary">{l s='Typing "full/half/quarter" in width or data height to set size (full/half/quarter slide) quickly for layer' mod='gdz_slider'}</li>
	            	<li  class="text-danger">{l s='Using show/hide layer function (icon eye) to easly working.' mod='gdz_slider'}</li>
	            </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</form>
<!-- end first form  -->
<form id="form_add_layer" action="" method="post" enctype="multipart/form-data">
<div id="modal_add_image" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	                <h4 class="modal-title">{l s='Add Image' mod='gdz_slider'}</h4>
	            </div>
	            <div class="modal-body">
	            	<p>{l s='Title layer' mod='gdz_slider'}</p>
            		<p><input type="text" id="title_image_new" name="title_image_new"></p>
	            	<div id="image_action" class="form-group clearfix" >
	            		<label class="control-label col-lg-3">{l s='Type Action' mod='gdz_slider'}</label>
						<div class="col-lg-9">
							<span class="switch prestashop-switch fixed-width-lg">
								<input type="radio" value="select" id="data_image_action_select" checked name="data_image_action">
								<label for="data_image_action_select">{l s='Select' mod='gdz_slider'}</label>
								<input type="radio" value="upload" id="data_image_action_upload" name="data_image_action">
								<label for="data_image_action_upload">{l s='Upload' mod='gdz_slider'}</label>
								<a class="slide-button btn"></a>
							</span>
						</div>
	            	</div>
	            	<div id="form_upload_image" class="form-group clearfix">
						<label class="control-label col-lg-3">{l s='Upload file' mod='gdz_slider'}</label>
						<div class="col-sm-9">
							<input type="file" class="hide" name="data_image" id="data_image">
							<div class="dummyfile input-group">
								<span class="input-group-addon"><i class="icon-file"></i></span>
								<input type="text" readonly="" name="filename" id="data_image-name">
								<span class="input-group-btn">
									<button class="btn btn-default" name="submitAddAttachments" type="button" id="data_image-selectbutton">
										<i class="icon-folder-open"></i> {l s='Choose a file' mod='gdz_slider'}
									</button>
								</span>
							</div>
						</div>
					</div>
	            	<div id="form_select_image" class="form-group  clearfix">
	            		<label class="control-label col-lg-3">{l s='Select image' mod='gdz_slider'}</label>
	            		<select class="col-lg-9" name="data_s_image" id="data_s_image">
	            			{foreach from=$images item=image}
	            				<option  value="{$image.id nofilter}">{$image.id nofilter}</option>
	            			{/foreach}
	            		</select>
	            	</div>
	            	<div class="show-error" style="color:#ff0000"></div>

	            	<p id='loading' class="loading loading-image" style="text-align:center; display:none;"><img  src="{$root_url nofilter}/modules/gdz_slider/views/img/settings/loading.gif" alt="loading"></p>
	            </div>
	            <div class="modal-footer clearfix">
	                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-primary" id="submitLayerImage" name="submitLayer">Save</button>
	            </div>
        </div>
    </div>
</div> <!-- end modal add image -->
</form>


