{**
* 2007-2020 PrestaShop
*
* Godzilla Slider
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*}

<div id="layer-tools" class="layer-tools">
    <div id="add-layer-wrap">
        <a class="btn btn-default" id="add-layer">
            <i class="material-icons">add</i> {l s='Add Layer' d='gdz_slider'}
        </a>
        <ul class="add-layer-list">
            <li><a id="add-text"><i class="material-icons">assignment</i> {l s='Text' d='gdz_slider'}</a></li>
            <li><a id="add-image"><i class="material-icons">collections</i> {l s='Image' d='gdz_slider'}</a></li>
            <li><a id="add-video"><i class="material-icons">video_librarys</i> {l s='Video' d='gdz_slider'}</a></li>
            <!-- <li><a id="add-link"><i class="material-icons">add</i> {l s='Link' d='gdz_slider'}</a></li> -->
        </ul>
    </div>
        {include './quick-layer-list.tpl'}
    <a class="btn btn-default pull-right mobile-style"><i class="material-icons" style="transform: rotateZ(90deg)">
tablet</i></i> {l s='Mobile Style 2' d='gdz_slider'}</a>
    <a class="btn btn-default pull-right mobile2-style"><i class="material-icons" style="transform: rotateZ(90deg)">
tablet</i></i> {l s='Mobile Style' d='gdz_slider'}</a>
    <a class="btn btn-default pull-right tablet-style"><i class="material-icons">tablet_mac</i> {l s='Tablet Style' d='gdz_slider'}</a>
    <a class="btn btn-default pull-right desktop-style btn-active"><i class="material-icons">desktop_windows</i> {l s='Desktop Style' d='gdz_slider'}</a>
</div>