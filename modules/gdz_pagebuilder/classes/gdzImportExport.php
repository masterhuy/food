<?php
/**
* 2007-2020 PrestaShop
*
Godzilla PageBuilder
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

class gdzImportExport extends Module
{
    public function __construct()
    {
        $this->name = _GDZ_PB_NAME_;
        parent::__construct();
    }
    public function getPage($id_page)
    {
        $context = Context::getContext();
        $id_lang = $context->language->id;
        $id_shop = $context->shop->id;
        $req = "SELECT pbpl.title, pbp.params
                FROM `"._DB_PREFIX_."gdz_pagebuilder_pages_lang` pbpl
                INNER JOIN "._DB_PREFIX_."gdz_pagebuilder_pages pbp ON pbp.id_page = pbpl.id_page
                INNER JOIN "._DB_PREFIX_."gdz_pagebuilder pb ON pbpl.id_page = pb.id_page
                WHERE pbpl.id_lang = '".$id_lang."' AND pb.id_shop = '".$id_shop."' AND pbpl.`id_page` = ".(int)$id_page;
        //echo $req; exit;
        $page = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow($req);
        return ($page);
    }

    public function exportPage($id_page)
    {
        $page = $this->getPage($id_page);
        $filename = str_replace(' ', '_', $page['title']).'.txt';
        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="'.Tools::strtolower($filename).'"');
        $_output = $page['params'];
        echo $_output;
        exit;
    }
    public function import($json)
    {
        $rows = (array)Tools::jsonDecode($json);
        $bresult = array();
        $b_index = 0;
        foreach ($rows as $key => $row) {
            $row_css = '';
            $row->id = 'row-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
            $row_css .= gdzPageBuilderHelper::parseStyleItem('row', $row);
            $row->class = $row->settings->custom_class;
            if($row->settings->animation) {
                $row->class .= " animated ".$row->settings->animation;
            }
            if(isset($row->settings->content_align) && $row->settings->content_align != '') {
                $row->class .= " ".$row->settings->content_align."-align";
            }
            if($row->settings->hidden_mobile) {
                $row->class .= " pb-hidden-xs";
            }
            if($row->settings->hidden_tablet) {
                $row->class .= " pb-hidden-sm";
            }
            if($row->settings->hidden_desktop) {
                $row->class .= " pb-hidden-md";
            }
            $bresult[] = $row;
            $columns = $rows[$key]->cols;
            foreach ($columns as $ckey => $column) {
                $column->id = 'col-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                $row_css .= gdzPageBuilderHelper::parseStyleItem('column', $column);
                $column->class = $column->settings->lg_col." ".$column->settings->sm_col." ".$column->settings->xs_col." ".$column->settings->custom_class;
                if($column->settings->animation) {
                    $column->class .= " animated ".$column->settings->animation;
                }
                if(isset($column->settings->content_align) && $column->settings->content_align != '') {
                    $column->class .= " ".$column->settings->content_align."-align";
                }
                if($column->settings->hidden_mobile) {
                    $column->class .= " pb-hidden-xs";
                }
                if($column->settings->hidden_tablet) {
                    $column->class .= " pb-hidden-sm";
                }
                if($column->settings->hidden_desktop) {
                    $column->class .= " pb-hidden-md";
                }
                $addons = $column->addons;
                foreach ($addons as $akey => $addon) {
                    $addon->id = 'addon-'.Tools::substr(md5(uniqid(mt_rand(), true)), 0, 9);
                    $row_css .= gdzPageBuilderHelper::parseStyleItem('addon', $addon);
                    $bresult[$b_index]->cols[$ckey]->addons[$akey]->return_value = gdzPageBuilderHelper::loadAddon($addon);
                }
            }
            $bresult[$b_index]->style = $row_css;
            $b_index++;

        }
        $context->smarty->assign(
            array(
                'rows' => $bresult
            )
        );
        $html = $context->smarty->fetch(_PS_MODULE_DIR_._GDZ_PB_NAME_."/views/templates/admin/preview_rows.tpl");
        $rs = array(
            'html' => $html,
            'params' => $rows,
        );
        dump($rs);exit;
    }
}
