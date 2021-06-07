{foreach $linkBlocks as $linkBlock}
    <div class="layout-column wrapper block">
      <h3 class="h3 block-title">
        {$linkBlock.title}
        <i class="feather icon-plus closing"></i>
        <i class="feather icon-minus opening"></i>
      </h3>
      <div class="block-content">
        <ul>
          {foreach $linkBlock.links as $link}
            <li>
              <a
                  id="{$link.id}-{$linkBlock.id}"
                  class="{$link.class}"
                  href="{$link.url}"
                  title="{$link.description}">
                {$link.title}
              </a>
            </li>
          {/foreach}
        </ul>
      </div>
    </div>
  {/foreach}
