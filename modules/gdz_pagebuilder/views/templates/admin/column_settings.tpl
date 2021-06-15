<div id="column-settings" class="hidden">
    <div class="column-settings">
        <ul role="tablist" class="nav nav-tabs">
        {foreach from=$column_settings key=i item=column_setting}
            <li class="{if $i==0}active{/if}"><a data-toggle="tab" href="#column-{$column_setting.id}"><i class="gdz-icon-{$column_setting.id}"></i>{$column_setting.title}</a></li>
        {/foreach}
        </ul>
        <div class="tab-content">
          {foreach from=$column_settings key=i item=setting}
              {include file="module:gdz_pagebuilder/views/templates/admin/settings.tpl" stype="column"}
          {/foreach}
        </div>
    </div>
</div>
