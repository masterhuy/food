<div id="row-settings" class="hidden">
    <div class="row-settings">
        <ul role="tablist" class="nav nav-tabs">
        {foreach from=$row_settings key=i item=row_setting}
            <li class="{if $i==0}active{/if}"><a data-toggle="tab" href="#row-{$row_setting.id}"><i class="gdz-icon-{$row_setting.id}"></i>{$row_setting.title}</a></li>
        {/foreach}
        </ul>
        <div class="tab-content">
        {foreach from=$row_settings key=i item=setting}
            {include file="module:gdz_pagebuilder/views/templates/admin/settings.tpl" stype="row"}
        {/foreach}
        </div>
    </div>
</div>
