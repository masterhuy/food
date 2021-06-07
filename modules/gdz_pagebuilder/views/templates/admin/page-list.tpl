<h3>Pages</h3>
{foreach $pages.category as $i => $page}
  <div class="category-box {if !$i}active{/if}">
    <div class="studio-category">{$page.name} ({$page.styles|count})</div>
    <div class="box-list">
      {foreach $page.styles as $style}
      <div class="studio-box">
        <div class="studio-action">
          <a class="import-studio" href="#" data-name="{$style.folder}">{l s='Import' mod='gdz_pagebuilder'}</a>
        </div>
        <img src="{$pages.url}{$style.folder}/{$style.preview}" />
      </div>
      {/foreach}
    </div>
  </div>
{/foreach}