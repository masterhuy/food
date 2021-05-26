<div id="blockcart-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="feather icon-x"></i>          
      </button>
      <div class="modal-body">
        <h4 class="modal-title text-xs-center" id="myModalLabel">{l s='Added to Cart Successfully!' d='Shop.Theme.Checkout'}</h4>
        <img class="product-image" src="{$product.cover.medium.url}" alt="{$product.cover.legend}" title="{$product.cover.legend}" itemprop="image">
        <h6 class="h6 product-name">{$product.name}</h6>
        <div class="content_price">
          <span class="price new">{$product.price}</span>
        </div>
        {hook h='displayProductPriceBlock' product=$product type="unit_price"}
        <div class="product-attributes">
        {foreach from=$product.attributes item="property_value" key="property"}
        <span>{l s='%label%:' sprintf=['%label%' => $property] d='Shop.Theme.Global'}<strong> {$property_value}</strong></span>
        {/foreach}
        </div>
        <div class="total-price price">{l s='Total:' d='Shop.Theme.Checkout'}{$cart.totals.total.value} {$cart.labels.tax_short}</div>
        <a class="btn btn-default" data-dismiss="modal">{l s='Continue shopping' d='Shop.Theme.Actions'}</a>
        <a href="{$cart_url}" class="btn btn-default btn-active">{l s='proceed to checkout' d='Shop.Theme.Actions'}</a>
      </div>
    </div>
  </div>
</div>
