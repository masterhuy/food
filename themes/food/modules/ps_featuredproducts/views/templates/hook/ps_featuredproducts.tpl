<section class="featured-products clearfix">
	<div class="addon-title">
		<h3 class="products-section-title text-uppercase ">
			{l s='Popular Products' d='Shop.Theme.Catalog'}
		</h3>
	</div>
  <div class="product_box">
    <div class="products customs-carousel-product items-carousel" data-items="4" data-lg="4" data-md="3" data-sm="2" data-xs="1">
      {foreach from=$products item="product"}
          <div class="item ajax_block_product">
            {include file="catalog/_partials/miniatures/product.tpl" product=$product}
          </div>
      {/foreach}
    </div>
  </div>
</section>
