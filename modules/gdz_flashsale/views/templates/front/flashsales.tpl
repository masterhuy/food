
{extends file='page.tpl'}
{block name='page_content'}
<div class="gdz_flashsale">
	<div class="row">
		<div class="item-hover">
			{foreach from=$products item=product key=k}
					<div class="product-miniature js-product-miniature product-box col-lg-3" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}">
					<div class="preview">
						{block name='product_thumbnail'}
						  <a href="{$product.url}" class="product-image {if isset($jpb_phover) && $jpb_phover == 'image_swap'}image_swap{else}image_blur{/if}">
							<img class="img-responsive product-img1"
							  src = "{$product.cover.bySize.large_default.url}"
							  alt = "{$product.cover.legend}"
							  data-full-size-image-url = "{$product.cover.large.url}"
							/>
							{if isset($jpb_phover) && $jpb_phover == 'image_swap' && $product.images.1}
								<img class="img-responsive product-img2"
								  src = "{$product.images.1.bySize.large_default.url}"
								  alt = "{$product.images.1.legend}"
								  data-full-size-image-url = "{$product.images.1.large.url}"
								/>
							{/if}
						  </a>
							{block name='product_flags'}
								{foreach from=$product.flags item=flag}
									{if $flag.label == 'New'}
									<span class="label label-new">{$flag.label}</span>
									{/if}
									{if $flag.label == 'On sale!'}
									<span class="label label-sale">{l s='Sale' d='Shop.Theme'}</span>
									{/if}
								{/foreach}
							{/block}
						{/block}
							{block name='product_variants'}
								{if $product.main_variants && isset($jpb_pcolor) && $jpb_pcolor == 1}
									<div class="color_to_pick_list">
										{include file='catalog/_partials/variant-links.tpl' variants=$product.main_variants}
									</div>
								{/if}
							{/block}
					</div>
				    <div class="product-info">
				    	<div class="product-cat">
							<a href="{url entity='category' id=$product.id_category_default}" title="{$product.category_name}">{$product.category_name}</a>
						</div>
					    {block name='product_name'}
							<a href="{$product.link|escape:'html'}" class="product-name">{$product.name|escape:'html':'UTF-8'}</a>
					    {/block}
					    {if isset($configuration.is_catalog) && !$configuration.is_catalog}
						    {block name='product_price_and_shipping'}
						        {if $product.show_price}
						          <div class="content_price">
						            {if $product.has_discount}
						              {hook h='displayProductPriceBlock' product=$product type="old_price"}
						              <span class="old price">{$product.regular_price}</span>
						            {/if}
						            {hook h='displayProductPriceBlock' product=$product type="before_price"}
						            <span class="price new">{$product.price}</span>

						            {hook h='displayProductPriceBlock' product=$product type='unit_price'}

						            {hook h='displayProductPriceBlock' product=$product type='weight'}
						          </div>
						        {/if}
						    {/block}
					    {/if}
					    {if isset($configuration.is_catalog) && !$configuration.is_catalog}
							<button {if $product.quantity < 1 && !$product.add_to_cart_url}disabled{/if} data-button-action="add-to-cart" class="ajax-add-to-cart product-btn cart-button {if $product.quantity < 1}disabled{/if}" data-id-product="{$product.id}" data-minimal-quantity="{$product.minimal_quantity}" data-token="{if isset($static_token) && $static_token}{$static_token}{/if}">
								<span class="icon-basket"></span>
								{l s='Add To Cart' mod='gdz_flashsale'}
							</button>
						{/if}
				    </div>
			</div>

			{/foreach}
		</div>
		</div>
</div>
{/block}
