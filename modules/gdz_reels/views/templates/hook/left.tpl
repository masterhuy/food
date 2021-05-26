{foreach $reels as $reel}
<div class="gdz_reel gdz_row" data-autoplay="{$reel->autoplay}">
    <div class="container" {if $reel->video_position == 'right'}style="flex-direction:row-reverse"{/if}>
        <div class="video-width center" style="flex: 0 0 {$reel->video_width}%">
            {if $reel->video.type == 'video'}
            <div class="video">
                <video controls {if $reel->autoplay}muted{/if} loop class="reel_video" width="100%">
                    <source src="{$reel->video.url}" type="video/mp4">
                    Your browser does not support HTML video.
                </video>
                <div class="play center">
                    <span class="fa fa-play"></span>
                </div>
            </div>
            {elseif $reel->video.type == 'embed'}
            <div class="videoWrapper">
                {$reel->video.code nofilter}
            </div>
            {/if}
        </div>
        <div class="center" style="position: relative;">
            <div class="lookbooks">
                {assign var='counter' value=1}
                {foreach $reel->lookbooks as $i => $lookbook}
                    {if $lookbook->products|count}
                    <div class="lookbook">
                        <h3 class="lb-title">{l s='Look book' mod='gdz_reels'} {$counter}</h3>
                        {foreach $lookbook->products as $j => $product}
                        <div class="lookbook-product animated" animate="{$reel->animate}" duration="{$product->duration}">
                            <form action="{$urls.pages.cart}" method="post" class="product row">
                                <input type="hidden" name="token" value="{$static_token}">
                                <input type="hidden" name="id_product" value="{$product->id}" id="product_page_product_id">
                                <input type="hidden" name="id_customization" value="0" id="product_customization_id">
                                <input type="hidden" name="qty" value="1" min="{$product->minimal_quantity}">
                                <input type="hidden" name="add" value="1">
                                <input type="hidden" name="action" value="update">
                                <div class="image center">
                                    <a href="{$link->getProductLink($product)}">
                                        <img class="thumb" src="{$link->getImageLink($product->link_rewrite[$id_lang], $product->getCoverWs())}">
                                    </a>
                                </div>
                                <div class="desc">
                                    <a href="{$link->getProductLink($product)}">
                                        <p class="name">{$product->name[$id_lang]}</p>
                                    </a>
                                    <div class="groups">
                                    {foreach $product->groups as $id_attribute_group => $group}
                                        <div class="form-group">
                                        <p>{$group.name}</p>
                                            <div class="attributes">
                                            {foreach $group.attributes as $id_attribute => $attribute}
                                                <div class="attribute">
                                                    <input type="radio" name="group[{$id_attribute_group}]" value="{$id_attribute}" {if $id_attribute == $group.default}checked{/if}>
                                                    <label>{$attribute.name}</label>
                                                </div>
                                            {/foreach}
                                            </div>
                                        </div>
                                    {/foreach}
                                    </div>
                                </div>
                                <div class="center price">
                                    {Tools::displayPrice($product->price)}
                                </div>
                                <div class="center action">
                                    <div class="buttons">
                                        <a class="btn btn-default" href="{$link->getProductLink($product)}">{l s='View' mod='gdz_reels'}</a>
                                        <input type="submit" class="btn btn-default" value="{l s='Add to Cart' mod='gdz_reels'}">
                                    </div>
                                </div>
                                <div class="center action-m">
                                    <input type="submit" class="btn btn-default" value="{l s='Add' mod='gdz_reels'}">
                                </div>
                            </form>
                            <hr>

                        </div>
                        {/foreach}
                    </div>
                    {/if}
                {$counter = $counter + 1}
                {/foreach}
            </div>
        </div>
    </div>
    <div class="container">
        <div style="flex: 0 0 {$reel->video_width}%">
        </div>
        <div class="repeat center">
            <button class="btn btn-default gdz-repeat">{l s='Repeat' mod='gdz_reels'}</button>
        </div>
    </div>
</div>
{/foreach}