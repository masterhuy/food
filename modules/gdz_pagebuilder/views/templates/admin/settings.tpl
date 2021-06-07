    <div id="{$stype}-{$setting.id}" aria-labelledby="{$stype}-{$setting.id}" role="tabpanel" class="tab-pane {if $i==0}active{/if}">
        {foreach from=$setting.content key=field_id item=field}
            <div class="form-group{if isset($field.class)} {$field.class}{/if}">
                <label>{$field.title}</label>
                {if $field.type == 'text'}
                    <input type="text" value="" data-attrname="{$field_id}" class="form-control addon-input addon-{$field_id}" />
                {elseif $field.type == 'number'}
                    <input type="number" value="{if isset($field.default)}{$field.default}{/if}" data-attrname="{$field_id}" class="form-control addon-input addon-{$field_id}" />
                {elseif $field.type == 'color'}
                    <div class="input-group colorpicker-component color-picker-component">
                        <input data-attrname="{$field_id}" type="text" value="#38a677" name="text_color" class="form-control addon-input"/>
                        <span class="input-group-addon"><i></i></span>
                    </div>
                {elseif $field.type == 'checkbox'}
                    <div class="pagebuilder-checkbox">
                        <input type="checkbox" data-attrname="{$field_id}" class="addon-input input-{$field_id} gdz-switch">
                    </div>
                {elseif $field.type == 'image'}
                    <div class="media-upload" data-url="{$link->getAdminLink('AdminGdzpagebuilderMedia') nofilter}&fid={$fid}">
                        <div class="media-image-preview media-preview" id="media-preview-{$fid}"></div>
                        <div class="media-image-delete">{l s='Delete' mod='gdz_pagebuilder'}</div>
                        <div class="media-image-empty-button"><i class="fa fa-plus-circle"></i></div>
                    </div>
                    <input name="{$field_id}" data-attrname="{$field_id}" type="text" data-type="image" class="media-value addon-input form-control input-media" id="media-value-{$fid}" data-fid="{$fid}" />
                {elseif $field.type == 'select'}
                    <select data-attrname="{$field_id}" class="form-control addon-input">
                    {foreach from=$field.options key=op_key item=option}
                        <option value="{$op_key}">{$option}</option>
                    {/foreach}
                    </select>
                {elseif $field.type == 'range'}
                    <div class="pb-range-input">
                      <input type="range" class="pb-range" min="{$field.min}" max="{$field.max}">
                      <input type="number" class="form-control addon-input input-range" data-attrname="{$field_id}" data-type="range">
                    </div>
                {elseif $field.type == 'padding'}
                    <ul class="pb-device-tabs pb-device-md">
                      <li class="screen-md"><i class="icon-desktop icon-md"></i></li>
                      <li class="screen-sm"><i class="icon-tablet icon-sm"></i></li>
                      <li class="screen-xs"><i class="icon-mobile icon-xs"></i></li>
                    </ul>
                    <div class="pb-screen-inputs pb-device-md">
                      <div class="pb-padding-input md">
                        <ul>
                            <li><input type="number" class="form-control addon-input" data-attrname="md_{$field_id}_top" /><span>{l s='Top' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="md_{$field_id}_right" /><span>{l s='Right' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="md_{$field_id}_bottom" /><span>{l s='Bottom' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="md_{$field_id}_left" /><span>{l s='Left' mod='gdz_pagebuilder'}</span></li>
                        </ul>
                      </div>
                      <div class="pb-padding-input sm">
                        <ul>
                            <li><input type="number" class="form-control addon-input" data-attrname="sm_{$field_id}_top" /><span>{l s='Top' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="sm_{$field_id}_right" /><span>{l s='Right' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="sm_{$field_id}_bottom" /><span>{l s='Bottom' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="sm_{$field_id}_left" /><span>{l s='Left' mod='gdz_pagebuilder'}</span></li>
                        </ul>
                      </div>
                      <div class="pb-padding-input xs">
                        <ul>
                            <li><input type="number" class="form-control addon-input" data-attrname="xs_{$field_id}_top" /><span>{l s='Top' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="xs_{$field_id}_right" /><span>{l s='Right' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="xs_{$field_id}_bottom" /><span>{l s='Bottom' mod='gdz_pagebuilder'}</span></li>
                            <li><input type="number" class="form-control addon-input" data-attrname="xs_{$field_id}_left" /><span>{l s='Left' mod='gdz_pagebuilder'}</span></li>
                        </ul>
                      </div>
                    </div>
                {/if}
                {if isset($field.desc) && $field.desc}
                    <p class="help-block">{$field.desc}</p>
                {/if}
          </div>
      {/foreach}
  </div>
