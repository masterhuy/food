{if $page.page_name|strpos:'preview' ||  $page.page_name|strpos:'gdz_pagebuilder'}
<div class="grid">
    <div class="grid_row row">
        {foreach $grid as $g}
            <div class="col-lg-{$g->col->lg} col-sm-{$g->col->sm} col-xs-{$g->col->xs} grid_column addon-sortable dragenterable" lg="{$g->col->lg}" sm="{$g->col->sm}" xs="{$g->col->xs}">
                {foreach $g->addons as $addon}
                    <div id="{$addon->id|escape:'htmlall':'UTF-8'}" class="addon-box" data-name="{$addon->type}">
                        <div class="pb-addon-tools">
                            <a href="#" class="pb-drag-arrow pull-right"><i class="fa fa-arrows-alt"></i></a>
                            <a href="#" class="pb-addon-setting pull-right"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="pb-addon-duplicate pull-right"><i class="fa fa-files-o"></i></a>
                            <a href="#" class="pb-addon-delete pull-right"><i class="fa fa-trash-o"></i></a>
                        </div>
                        <div class="addon-body">
                            {if isset($addon->return_value) && $addon->return_value}{$addon->return_value nofilter}{/if}
                        </div>
                    </div>
                {/foreach}
            </div>
        {/foreach}
    </div>
</div>
{else}
<div class="grid">
    <div class="grid_row row">
        {foreach $grid as $g}
            <div class="col-lg-{$g->col->lg} col-sm-{$g->col->sm} col-xs-{$g->col->xs} grid_column">
                {foreach $g->addons as $addon}
                    <div id="{$addon->id|escape:'htmlall':'UTF-8'}" class="addon-box">
                        {if isset($addon->return_value) && $addon->return_value}{$addon->return_value nofilter}{/if}
                    </div>
                {/foreach}
            </div>
        {/foreach}
    </div>
</div>
{/if}
