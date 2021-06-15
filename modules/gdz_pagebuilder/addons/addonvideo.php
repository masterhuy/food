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

if (!defined('_PS_VERSION_')) {
    exit;
}
include_once(_PS_MODULE_DIR_._GDZ_PB_NAME_.'/addons/addonbase.php');

class gdzAddonVideo extends gdzAddonBase
{
    public function __construct()
    {
        $this->addonname = 'video';
        $this->modulename = _GDZ_PB_NAME_;
        $this->addontitle = 'Video';
        $this->addondesc = 'Easy to add Video';
        $this->type = 'Addons';
        $this->ordering = 9;
        $this->overwrite_tpl = '';
        $this->context = Context::getContext();

    }
    public function getInputs()
    {
        $inputs = array(
            array(
                'type' => 'select',
                'name' => 'video_type',
                'label' => $this->l('Video Type'),
                'lang' => '0',
                'desc' => 'Video Type : Youtube or Vimeo.',
                'options' => array('youtube', 'vimeo'),
                'default' => 'youtube'
            ),
            array(
                'type' => 'text',
                'name' => 'youtube_link',
                'label' => $this->l('Youtube Link'),
                'lang' => '0',
                'desc' => 'Enter youtube video link',
                'default' => 'https://www.youtube.com/watch?v=6t-MjBazs3o',
                'condition' => array(
                    'video_type' => '==youtube'
                ),
            ),
            array(
                'type' => 'text',
                'name' => 'vimeo_link',
                'lang' => '0',
                'label' => $this->l('Vimeo Link'),
                'default' => 'https://vimeo.com/71721306',
                'desc' => 'Enter vimeo link',
                'condition' => array(
                    'video_type' => '==vimeo'
                ),
            ),
            array(
                'type' => 'select',
                'name' => 'aspect_ratio',
                'label' => $this->l('Aspect Ratio'),
                'lang' => '0',
                'desc' => 'Video Aspect Ratio',
                'options' => array('16-9', '3-2', '4-3'),
                'default' => '16-9'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'video_modal',
                'label' => $this->l('Video in Modal'),
                'lang' => '0',
                'desc' => 'Video show in modal. click to icon video to show modal',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'autoplay',
                'label' => $this->l('Auto Play'),
                'lang' => '0',
                'desc' => 'Video auto play',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'loop',
                'label' => $this->l('Loop'),
                'lang' => '0',
                'desc' => 'Video Loop',
                'default' => '0'
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'introtitle',
                'label' => $this->l('Intro Title'),
                'lang' => '0',
                'desc' => 'Show Intro Title',
                'default' => '0',
                'condition' => array(
                    'video_type' => '==vimeo'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'introportrait',
                'label' => $this->l('Intro Portrait'),
                'lang' => '0',
                'desc' => 'Show Intro Portrait',
                'default' => '0',
                'condition' => array(
                    'video_type' => '==vimeo'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'introbyline',
                'label' => $this->l('Intro Byline'),
                'lang' => '0',
                'desc' => 'Show Intro ByLine',
                'default' => '0',
                'condition' => array(
                    'video_type' => '==vimeo'
                ),
            ),
            array(
                'type' => 'color',
                'name' => 'controlscolor',
                'label' => $this->l('Controls Color'),
                'lang' => '0',
                'desc' => 'Set color for Controls',
                'default' => '',
                'condition' => array(
                    'video_type' => '==vimeo'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'playercontrol',
                'label' => $this->l('Player Control'),
                'lang' => '0',
                'desc' => 'Show Player Control',
                'default' => '0',
                'condition' => array(
                    'video_type' => '==youtube'
                ),
            ),
            array(
                'type' => 'checkbox2',
                'name' => 'playertitleactions',
                'label' => $this->l('Player Title & Actions'),
                'lang' => '0',
                'desc' => 'Show Player Title & Actions',
                'default' => '0',
                'condition' => array(
                    'video_type' => '==youtube'
                ),
            ),
            array(
                'type' => 'text',
                'name' => 'box_class',
                'label' => $this->l('Box Class'),
                'lang' => '0',
                'desc' => 'Use this class to style for this box',
                'default' => ''
            ),
            array(
                'type' => 'text',
                'name' => 'overwrite_tpl',
                'label' => $this->l('Overwrite Tpl File'),
                'lang' => '0',
                'desc' => 'Use When you want overwrite template file'
            )
        );
        return $inputs;
    }
    public function returnValue($addon)
    {
        $video_type = $addon->fields[0]->value;
        $autoplay = $addon->fields[5]->value;
        $loop = $addon->fields[6]->value;
        $introtitle = $addon->fields[7]->value;
        $introportrait = $addon->fields[8]->value;
        $introbyline = $addon->fields[9]->value;
        $controlscolor = $addon->fields[10]->value;
        $playercontrol = $addon->fields[11]->value;
        $playertitleactions = $addon->fields[12]->value;
        if($video_type == 'youtube') {
            $video_source = gdzPageBuilderHelper::getVideoSrc($addon->fields[1]->value);
            $video_urls = explode( "/", $video_source);
            $id = $video_urls[count($video_urls) -1];
            $video_setting = $autoplay ? 'autoplay=1&mute=1' :'autoplay=0';
            $video_setting .= $loop ? '&loop=1&playlist='.$id :'&loop=0';
            $video_setting .= $playercontrol ? '&controls=1' :'&controls=0';
            $video_setting .= $playertitleactions ? '&showinfos=1' :'&showinfos=0';
        } else {
            $video_source = gdzPageBuilderHelper::getVideoSrc($addon->fields[2]->value);
            $video_setting = $autoplay ? 'autoplay=1&muted=1' :'autoplay=0';
            $video_setting .= $loop ? '&loop=1' :'&loop=0';
            $video_setting .= $introtitle ? '&title=1' :'&title=0';
            $video_setting .= $introportrait ? '&portrait=1' :'&portrait=0';
            $video_setting .= $introbyline ? '&byline=1' :'&byline=0';
            $video_setting .= $controlscolor ? '&color='.$controlscolor : '';
        }
        $this->context->smarty->assign(
            array(
                'video_type'    => $addon->fields[0]->value,
                'video_source'  => $video_source,
                'video_setting' => $video_setting,
                'aspect_ratio'  => $addon->fields[3]->value,
                'video_modal'  => $addon->fields[4]->value,
                'box_class' => $addon->fields[7]->value
            )
        );
        $this->overwrite_tpl = $addon->fields[count($addon->fields)-1]->value;
        $template_path = $this->loadTplPath();
        return $this->context->smarty->fetch($template_path);
    }
}
