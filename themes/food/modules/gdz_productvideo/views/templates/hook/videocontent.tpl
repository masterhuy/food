{if $product_videos}
	<div class="jms-videos" id="gdz_productvideo">
		{foreach $product_videos as $video}
			<div class="jms-video {if $video_show == '1'}popup-active{/if}">
				{if $video_show == '1'}
					<a href="#" class="d-i-block js-open-video" title="Open video">
						<i class="d-i-flex align-items-center">
							<svg width="50" height="50">
								<use xlink:href="#icon-youtube">
									<symbol id="icon-youtube" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
										<path d="M20.824 8.263c-.105-.741-.357-1.355-.756-1.841-.386-.498-.96-.827-1.722-.984a22.231 22.231 0 0 0-2.04-.256 46.926 46.926 0 0 0-3.673-.164L12 5l-.65.018a47.334 47.334 0 0 0-3.656.164c-.739.061-1.419.146-2.04.256-.761.157-1.341.486-1.74.984-.387.486-.633 1.1-.738 1.841a22.252 22.252 0 0 0-.158 2.443L3 12l.018 1.313c.011.862.064 1.67.158 2.424.105.741.351 1.361.738 1.86.398.485.979.807 1.74.965.621.11 1.301.195 2.04.256.738.06 1.423.103 2.056.127a158.5 158.5 0 0 0 1.6.055h1.283c.433-.012.967-.03 1.6-.055a46.865 46.865 0 0 0 2.074-.127 22.252 22.252 0 0 0 2.039-.256c.761-.158 1.336-.48 1.722-.966.399-.498.65-1.118.756-1.859.094-.754.147-1.562.158-2.425L21 12l-.018-1.294a22.235 22.235 0 0 0-.158-2.443zM9.75 15.5v-7l5.625 3.5-5.625 3.5z" fill="currentColor"></path>
									</symbol>
								</use>
							</svg>
						</i>
					</a>
				{else}
					<h3 class="js-open-video">{$video.title}</h3>
				{/if}
				{if $video_show == '1'}
					<div class="jms-popup-box">
						<div class="jms-popup-wrap">
								<a class="popup-close">
									<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
										<g id="icon/navigation/close_24px">
										<path id="icon/navigation/close_24px_2" d="M23.75 8.0125L21.9875 6.25L15 13.2375L8.0125 6.25L6.25 8.0125L13.2375 15L6.25 21.9875L8.0125 23.75L15 16.7625L21.9875 23.75L23.75 21.9875L16.7625 15L23.75 8.0125Z" fill="black" fill-opacity="0.54"/>
										</g>
									</svg>
								</a>
								{foreach $video.links as $video_link}
									{if $video_link|strpos:'youtube' !== false}
										<iframe width="{$video_width}" height="{$video_height}" src="https://www.youtube-nocookie.com/embed/{$video_link|substr:($video_link|strpos:'?v='+3)}?rel=0&amp;controls=0&amp;showinfo=0{if $video_autoplay}&amp;autoplay=1{/if}" frameborder="0" allowfullscreen></iframe>
									{else}
										{assign var=count_ value = ("/"|explode:$video_link)}
										<iframe src="https://player.vimeo.com/video/{$count_[$count_|count-1]}{if $video_autoplay}?autoplay=1{/if}" width="{$video_width}" height="{$video_height}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
									{/if}
								{/foreach}
						</div>
						<div class="jms-popup-overlay" style="display:none;opacity:0;"></div>
					</div>
				{else}
					{foreach $video.links as $video_link}
						{if $video_link|strpos:'youtube' !== false}
							<iframe width="{$video_width}" height="{$video_height}" src="https://www.youtube-nocookie.com/embed/{$video.link|substr:($video_link|strpos:'?v='+3)}?rel=0&amp;controls=0&amp;showinfo=0{if $video_autoplay}&amp;autoplay=1{/if}" frameborder="0" allowfullscreen></iframe>
						{else}
							{assign var=count_ value = ("/"|explode:$video_link)}
							<iframe src="https://player.vimeo.com/video/{$count_[$count_|count-1]}{if $video_autoplay}?autoplay=1{/if}" width="{$video_width}" height="{$video_height}" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
						{/if}
					{/foreach}
				{/if}
			</div>
		{/foreach}
	</div>
{/if}

<style>
	.jms-popup-wrap {
		width : {$video_width}px;
		height :{$video_height}px;
		margin: -{$video_height/2}px 0 0 -{$video_width/2}px;
	}
</style>