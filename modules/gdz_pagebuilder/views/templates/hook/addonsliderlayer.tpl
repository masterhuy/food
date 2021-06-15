{**
* 2007-2020 PrestaShop
*
* Slider Layer module for prestashop
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*}
<div class="gdz-slider-wrapper">
	<div class="responisve-container">
		<div
			data-slideTransition = "{$slider->trans}"
			data-slideEndAnimation = "{$slider->end_animate}"
			data-transitionIn = "{$slider->trans_in}"
			data-transitionOut = "{$slider->trans_out}"
			data-fullWidth = "{$slider->full_width}"
			data-delay = "{$slider->delay}"
			data-timeout = "{$slider->duration}"
			data-speedIn = "{$slider->speed_in}"
			data-speedOut = "{$slider->speed_out}"
			data-easeIn = "{$slider->ease_in}"
			data-easeOut = "{$slider->ease_out}"
			data-controls = "{$slider->show_control}"
			data-pager = "{$slider->show_pager}"
			data-autoChange = "{$slider->auto_change}"
			data-pauseOnHover = "{$slider->pause_hover}"
			data-backgroundAnimation = "{$slider->bg_animation}"
			data-backgroundEase = "{$slider->bg_ease}"
			data-responsive = "{$slider->responsive}"
			data-dimensions = "{$slider->max_width},{$slider->max_height}"
			data-mobile_height = "{$slider->mobile_height}"
			data-mobile2_height = "{$slider->mobile2_height}"
			data-tablet_height = "{$slider->tablet_height}"
		 	class="slider" >
		<div class="fs_loader"></div>
		{foreach from=$slider->slides item=slide}
			<div class="slide {$slide->class_suffix}" style="background:{$slide->bg_color} url({$root_url nofilter}modules/gdz_slider/views/img/slides/{$slide->bg_image nofilter}) no-repeat center top;background-size:cover;" {if $slide->slide_link}onclick="document.location='{$slide->slide_link nofilter}';"{/if}>
				{foreach from=$slide->layers item=layer}
					{if $layer->data_type=='text'}
					<div class="{$layer->data_class_suffix nofilter} gdz-slide-content"
					{if $layer->data_fixed}data-fixed{/if}
					data-position="{$layer->desktop->data_y nofilter},{$layer->desktop->data_x nofilter}"
					data-fontsize = "{$layer->desktop->data_font_size nofilter}"
					data-mfontsize = "{$layer->mobile->data_font_size}"
					data-m2fontsize = "{$layer->mobile2->data_font_size}"
					data-tfontsize = "{$layer->tablet->data_font_size}"
					data-mposition="{$layer->mobile->data_y},{$layer->mobile->data_x}"
					data-m2position="{$layer->mobile2->data_y},{$layer->mobile2->data_x}"
					data-tposition="{$layer->tablet->data_y},{$layer->tablet->data_x}"
					data-mfont-weight = "{$layer->mobile->data_font_weight}"
					data-m2font-weight = "{$layer->mobile2->data_font_weight}"
					data-tfont-weight = "{$layer->tablet->data_font_weight}"
					data-font-weight = "{$layer->desktop->data_font_weight}"
					data-mline-height = "{$layer->mobile->data_line_height}"
					data-m2line-height = "{$layer->mobile2->data_line_height}"
					data-tline-height = "{$layer->tablet->data_line_height}"
					data-line-height = "{$layer->desktop->data_line_height}"
					data-show = "{$layer->desktop->data_show}"
					data-mshow = "{$layer->mobile->data_show}"
					data-m2show = "{$layer->mobile2->data_show}"
					data-tshow = "{$layer->tablet->data_show}"
					data-mstyle = "{$layer->mobile->data_style}"
					data-m2style = "{$layer->mobile2->data_style}"
					data-style = "{$layer->desktop->data_style}"
					data-tstyle = "{$layer->tablet->data_style}"
					data-in="{$layer->data_in nofilter}"
					data-out="{$layer->data_out nofilter}"
					data-delay="{$layer->data_delay nofilter}"
					data-ease-in="{$layer->data_ease_in nofilter}"
					data-ease-out="{$layer->data_ease_out nofilter}"
					data-transform-in="{$layer->data_transform_in nofilter}"
					data-transform-out="{$layer->data_transform_out nofilter}"
					data-time = "{$layer->data_time nofilter}"
					width="{$layer->data_width nofilter}"
					height="{$layer->data_height nofilter}"
					style="font-weight: {$layer->desktop->data_font_weight};font-size: {$layer->desktop->data_font_size nofilter}px; font-style:{$layer->desktop->data_style nofilter}; color: {$layer->data_color nofilter}; line-height:{if $layer->desktop->data_line_height}{$layer->desktop->data_line_height nofilter}px{/if};"
					>{$layer->data_html nofilter}
					</div>
					{elseif $layer->data_type=='image'}
					<img class="{$layer->data_class_suffix nofilter} gdz-slide-content"
					src="{$root_url nofilter}modules/gdz_slider/views/img/layers/{$layer->data_image nofilter}"
					{if $layer->data_fixed}data-fixed{/if}
					data-position="{$layer->desktop->data_y nofilter},{$layer->desktop->data_x nofilter}"
					data-mposition="{$layer->mobile->data_y},{$layer->mobile->data_x}"
					data-m2position="{$layer->mobile2->data_y},{$layer->mobile2->data_x}"
					data-tposition="{$layer->tablet->data_y},{$layer->tablet->data_x}"
					data-show = "{$layer->desktop->data_show}"
					data-mshow = "{$layer->mobile->data_show}"
					data-m2show = "{$layer->mobile2->data_show}"
					data-tshow = "{$layer->tablet->data_show}"
					data-in="{$layer->data_in nofilter}"
					data-out="{$layer->data_out nofilter}"
					data-delay="{$layer->data_delay nofilter}"
					data-ease-in="{$layer->data_ease_in nofilter}"
					data-ease-out="{$layer->data_ease_out nofilter}"
					data-transform-in="{$layer->data_transform_in nofilter}"
					data-transform-out="{$layer->data_transform_out nofilter}"
					data-time = "{$layer->data_time nofilter}"
					width="{$layer->data_width nofilter}"
					height="{$layer->data_height nofilter}"/>
					{else}

					<iframe class="{$layer->data_class_suffix nofilter} gdz-slide-content"
					{if $layer->data_fixed || $layer->data_video_bg}data-fixed{/if}
					data-position="{$layer->desktop->data_y nofilter},{$layer->desktop->data_x nofilter}"
					data-mposition="{$layer->mobile->data_y},{$layer->mobile->data_x}"
					data-m2position="{$layer->mobile2->data_y},{$layer->mobile2->data_x}"
					data-tposition="{$layer->tablet->data_y},{$layer->tablet->data_x}"
					data-show = "{$layer->desktop->data_show}"
					data-mshow = "{$layer->mobile->data_show}"
					data-m2show = "{$layer->mobile2->data_show}"
					data-tshow = "{$layer->tablet->data_show}"
					data-in="{$layer->data_in nofilter}"
					data-out="{$layer->data_out nofilter}"
					{if $layer->data_video_bg}data-delay="0"{else}data-delay="{$layer->data_delay nofilter}" {/if}
					data-ease-in="{$layer->data_ease_in nofilter}"
					data-ease-out="{$layer->data_ease_out nofilter}"
					data-transform-in="{$layer->data_transform_in nofilter}"
					data-transform-out="{$layer->data_transform_out nofilter}"
					data-time = "{$layer->data_time nofilter}"
					{if $layer->data_video_bg}
						width="{$slider->max_width}"
						height="{$slider->max_height}"
					{else}
						width="{$layer->data_width nofilter}"
						height="{$layer->data_height nofilter}"
					{/if}
					{if $layer->videotype == 'youtube'}
						src="http://www.youtube.com/embed/{$layer->data_video|substr:($layer->data_video|strpos:'?v='+3)}?autoplay={$layer->data_video_autoplay nofilter}&controls={$layer->data_video_controls nofilter}&loop={$layer->data_video_loop nofilter}"
					{else if $layer->videotype == 'vimeo'}
						 {assign var=vimeo_link value = ("/"|explode:$layer->data_video)}
						src="https://player.vimeo.com/video/{$vimeo_link[$vimeo_link|count-1]}?autoplay={$layer->data_video_autoplay nofilter}&loop={$layer->data_video_loop nofilter}" allow="autoplay"
					{/if}
					allowfullscreen
					frameborder="0">
					</iframe>
					{/if}
				{/foreach}
			</div>
		{/foreach}
		</div>
	</div>
</div>
