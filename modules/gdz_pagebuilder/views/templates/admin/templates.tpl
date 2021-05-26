{foreach from=$templates item=template}
      <div class="template-row" data-id="{$template.id_template}">
          <div class="template-name">{$template.name}</div>
          <div class="template-tools pull-right">
                <a class="template-export"><i class="gdz-icon-export"></i><span>{l s='Export' mod='gdz_pagebuilder'}</span></a>
                <a class="template-delete"><i class="gdz-icon-delete"></i><span>{l s='Delete' mod='gdz_pagebuilder'}</span></a>
                <a class="template-import"><i class="gdz-icon-import"></i><span>{l s='Import' mod='gdz_pagebuilder'}</span></a>
          </div>
      </div>
{/foreach}
