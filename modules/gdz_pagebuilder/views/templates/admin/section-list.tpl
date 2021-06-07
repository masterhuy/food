
<h3>Sections</h3>
{foreach $sections.category as $i => $section}
  <div class="category-box {if !$i}active{/if}">
    <div class="studio-category">{$section.name} ({$section.styles|count})</div>
    <div class="box-list">
      {foreach $section.styles as $style}
      <div class="studio-box">
        <div class="studio-action">
          <a class="import-studio" href="#" data-name="{$style.folder}">{l s='Import' mod='gdz_pagebuilder'}</a>
        </div>
        <img src="{$sections.url}{$style.folder}/{$style.preview}" />
      </div>
      {/foreach}
    </div>
  </div>
{/foreach}