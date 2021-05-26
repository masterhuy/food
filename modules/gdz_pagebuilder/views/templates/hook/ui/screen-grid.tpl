<ul class="pb-device-tabs pb-device-md">
    <li class="screen-md"><i class="icon-desktop icon-md"></i></li>
    <li class="screen-sm"><i class="icon-tablet icon-sm"></i></li>
    <li class="screen-xs"><i class="icon-mobile icon-xs"></i></li>
</ul>
<div class="pb-screen-inputs pb-device-md">
    <div class="pb-range-input md">
        <input type="text" class="form-control" value="{$values[0]}">
    </div>
    <div class="pb-range-input sm">
        <input type="text" class="form-control" value="{$values[1]}">
    </div>
    <div class="pb-range-input xs">
        <input type="text" class="form-control" value="{$values[2]}">
    </div>
</div>
<input name="{$field.name}" data-field="{$field.name}" type="hidden" class="addon-input" data-type="{$field.type}" data-attrname="{$field.name}" value="{$field.default}">