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
$animation_names = array(
		'' => 'Select Animation',
		'fadeIn' => 'fadeIn',
		'fadeInDown' => 'fadeInDown',
		'fadeInDown' => 'fadeInDown',
		'fadeInDownBig' => 'fadeInDownBig',
		'fadeInLeft' => 'fadeInLeft',
		'fadeInLeftBig' => 'fadeInLeftBig',
		'fadeInRight' => 'fadeInRight',
		'fadeInRightBig' => 'fadeInRightBig',
		'fadeInUp' => 'fadeInUp',
		'fadeInUpBig' => 'fadeInUpBig',
		'flip' => 'flip',
		'flipInX' => 'flipInX',
		'flipInY' => 'flipInY',
		'rotateIn' => 'rotateIn',
		'rotateInDownLeft' => 'rotateInDownLeft',
		'rotateInDownRight' => 'rotateInDownRight',
		'rotateInUpLeft' => 'rotateInUpLeft',
		'rotateInUpRight' => 'rotateInUpRight',
		'zoomIn' => 'zoomIn',
		'zoomInDown' => 'zoomInDown',
		'zoomInLeft' => 'zoomInLeft',
		'zoomInRight' => 'zoomInRight',
		'zoomInUp' => 'zoomInUp',
		'bounceIn' => 'bounceIn',
		'bounceInDown' => 'bounceInDown',
		'bounceInLeft' => 'bounceInLeft',
		'bounceInRight' => 'bounceInRight',
		'bounceInUp' => 'bounceInUp'
	);
$row_settings = array(
  	array(
        'title' => 'General',
        'id'  => 'general',
        'content' => array(
          	'name'=>array(
          			'type' => 'text',
          			'title' =>  'Row Name',
                'default' => 'Row',
          	),
          	'fluid'  =>  array(
            		'type'  =>  'checkbox',
            		'title' =>  $this->module->l('Fluid Width', 'settings'),
                'default' => 0,
            		'desc'  =>  $this->module->l('Enable this option to make this row fluid. Fluid row will help you to publish full width content', 'settings')
          	),
            'content_align'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Content Align', 'settings'),
                'options' => array('' => 'Default', 'top' => 'Top', 'middle' => 'Middle', 'bottom' => 'Bottom'),
                'default' => ''
          	),
            'custom_class'  =>  array(
            		'type'  =>  'text',
            		'title' =>  $this->module->l('Custom CSS Class', 'settings'),
                'default' => '',
                'desc'  =>  $this->module->l('Use this field to add a class name and then refer to it in your css file', 'settings')
          	),
            'text_color' =>  array(
                'type' => 'color',
                'title' =>  $this->module->l('Text Color', 'settings'),
                'default' => '',
                'desc' => $this->module->l('Set Text Color for Row', 'settings'),
            ),
            'background_color' =>  array(
                'type' => 'color',
                'title' =>  $this->module->l('Background Color', 'settings'),
                'default' => '',
                'desc' => $this->module->l('Set Background Color for Row', 'settings'),
            ),
          	'background_img' =>  array(
          			'type' => 'image',
          			'title' =>  $this->module->l('Background Image', 'settings'),
                'default' => '',
                'desc' => $this->module->l('Set Background Image for Row', 'settings'),
          	),
            'background_setting' =>  array(
                'type' => 'title',
                'title' =>  $this->module->l('Background Setting', 'settings'),
                'class' => 'title'
            ),
          	'background_size'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Size', 'settings'),
                'options' => array('cover' => 'Cover', 'contain' => 'Contain', 'inherit' => 'Inherit'),
                'default' => '',
                'class' => 'width-50'
          	),
            'background_repeat'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Repeat', 'settings'),
                'options' => array('no-repeat' => 'No Repeat', 'repeat' => 'Repeat All', 'repeat-x' => 'Repeat Horizontally', 'repeat-y' => 'Repeat Vertically', 'inherit' => 'Inherit'),
                'default' => '',
                'class' => 'width-50'
          	),
            'background_position'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Position', 'settings'),
                'options' => array('0 0' => 'Left Top', '0 50%' => 'Left Center', '0 100%' => 'Left Bottom', '50% 0' => 'Center Top', '50% 50%' => 'Center Center', '50% 100%' => 'Center Bottom', '100% 0' => 'Right Top', '100% 50%' => 'Right Center', '100% 100%' => 'Right Bottom'),
                'default' => '',
                'class' => 'width-50'
          	),
            'background_attachment'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Attachment', 'settings'),
                'default' => '',
                'options' => array('fixed' => 'Fixed', 'scroll' => 'Scroll', 'inherit' => 'Inherit'),
                'class' => 'width-50'
          	),
        )
    ),
    array(
        'title' => 'Responsive',
        'id'  => 'responsive',
        'content' => array(
            'hidden_desktop' =>  array(
                'type' => 'checkbox',
                'title' =>  $this->module->l('Hidden on Desktop', 'settings'),
                'default' => 0,
                'desc' => $this->module->l('Switch to ‘Yes’ if you want to hide this row on desktop (smaller) displays', 'settings')
            ),
            'hidden_tablet' =>  array(
          			'type' => 'checkbox',
          			'title' =>  $this->module->l('Hidden on Tablet', 'settings'),
                'default' => 0,
                'desc' => $this->module->l('Switch to ‘Yes’ if you want to hide this row on tablet (smaller) displays', 'settings')
          	),
          	'hidden_mobile' =>  array(
          			'type' => 'checkbox',
          			'title' =>  $this->module->l('Hidden on Mobile', 'settings'),
                'default' => 0,
                'desc' => $this->module->l('Switch to ‘Yes’ if you want to hide this row on mobile (smaller) displays', 'settings')
          	)
        )
    ),
    array(
        'title' => 'Advanced',
        'id'  => 'advanced',
        'content' => array(
            'margin' =>  array(
                'type' => 'padding',
                'title' =>  $this->module->l('Margin (px)', 'settings'),
                'default' => '0',
                'class' => 'screen-range',
                'desc' => $this->module->l('Margin for section', 'settings'),
            ),
            'padding' =>  array(
                'type' => 'padding',
                'title' =>  $this->module->l('Padding (px)', 'settings'),
                'default' => '0',
                'class' => 'screen-range',
                'desc' => $this->module->l('Padding for section', 'settings'),
            ),
          	'animation' =>  array(
          			'type' => 'select',
          			'title' =>  $this->module->l('Animation', 'settings'),
                'options' => $animation_names,
                'default' => '',
                'desc' => $this->module->l('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'settings'),
          	),
            'animation_duration'  =>  array(
            		'type'  =>  'range',
            		'title' =>  $this->module->l('Animation Duration (ms)', 'settings'),
                'default' => 0,
                'min' => 5,
                'max' => 3000,
                'desc'  =>  $this->module->l('Set how many milliseconds an animation will take to complete one cycle.', 'settings'),
          	),
            'animation_delay'  =>  array(
            		'type'  =>  'range',
            		'title' =>  $this->module->l('Animation Delay (ms)', 'settings'),
                'default' => 0,
                'min' => 0,
                'max' => 3000,
                'desc'  =>  $this->module->l('Set when the animation will start, this value is defined in milliseconds.', 'settings'),
          	),
        )
    ),
);
$column_settings = array(
  	array(
        'title' => 'General',
        'id'  => 'general',
        'content' => array(
            'content_align'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Content Align', 'settings'),
                'options' => array('' => 'Default', 'top' => 'Top', 'middle' => 'Middle', 'bottom' => 'Bottom'),
                'default' => ''
          	),
            'custom_class'  =>  array(
                'type'  =>  'text',
                'title' =>  $this->module->l('Custom CSS Class', 'settings'),
                'default' => '',
                'desc'  =>  $this->module->l('Use this field to add a class name and then refer to it in your css file', 'settings')
            ),
            'text_color' =>  array(
                'type' => 'color',
                'title' =>  $this->module->l('Text Color', 'settings'),
                'default' => '',
                'desc' => $this->module->l('Set Text Color for Column', 'settings'),
            ),
            'background_color' =>  array(
                'type' => 'color',
                'title' =>  $this->module->l('Background Color', 'settings'),
                'default' => '',
                'desc' => $this->module->l('Set Background Color for Column', 'settings'),
            ),
            'background_img' =>  array(
                'type' => 'image',
                'title' =>  $this->module->l('Background Image', 'settings'),
                'default' => '',
                'desc' => $this->module->l('Set Background Image for Column', 'settings'),
            ),
            'background_setting' =>  array(
                'type' => 'title',
                'title' =>  $this->module->l('Background Setting', 'settings'),
                'class' => 'title'
            ),
            'background_size'  =>  array(
                'type'  =>  'select',
                'title' =>  $this->module->l('Size', 'settings'),
                'options' => array('cover' => 'Cover', 'contain' => 'Contain', 'inherit' => 'Inherit'),
                'default' => '',
                'class' => 'width-50'
            ),
            'background_repeat'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Repeat', 'settings'),
                'options' => array('no-repeat' => 'No Repeat', 'repeat' => 'Repeat All', 'repeat-x' => 'Repeat Horizontally', 'repeat-y' => 'Repeat Vertically', 'inherit' => 'Inherit'),
                'default' => '',
                'class' => 'width-50'
          	),
            'background_position'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Position', 'settings'),
                'options' => array('0 0' => 'Left Top', '0 50%' => 'Left Center', '0 100%' => 'Left Bottom', '50% 0' => 'Center Top', '50% 50%' => 'Center Center', '50% 100%' => 'Center Bottom', '100% 0' => 'Right Top', '100% 50%' => 'Right Center', '100% 100%' => 'Right Bottom'),
                'default' => '',
                'class' => 'width-50'
          	),
            'background_attachment'  =>  array(
            		'type'  =>  'select',
            		'title' =>  $this->module->l('Attachment', 'settings'),
                'default' => '',
                'options' => array('fixed' => 'Fixed', 'scroll' => 'Scroll', 'inherit' => 'Inherit'),
                'class' => 'width-50'
          	)
        )
    ),
    array(
        'title' => 'Responsive',
        'id'  => 'responsive',
        'content' => array(
            'lg_col'  =>  array(
                'type'  =>  'select',
                'title' =>   $this->module->l('Desktop Layout', 'settings'),
                'options' => array('col-lg-1' => 'col-lg-1', 'col-lg-2' => 'col-lg-2', 'col-lg-3' => 'col-lg-3', 'col-lg-4' => 'col-lg-4', 'col-lg-5' => 'col-lg-5', 'col-lg-6' => 'col-lg-6', 'col-lg-7' => 'col-lg-7', 'col-lg-8' => 'col-lg-8', 'col-lg-9' => 'col-lg-9', 'col-lg-10' => 'col-lg-10', 'col-lg-11' => 'col-lg-11', 'col-lg-12' => 'col-lg-12'),
                'default' => 'col-lg-12',
                'desc'  =>   $this->module->l('Set the class of this column for desktops', 'settings'),
            ),
						'sm_col'  =>  array(
								'type'  =>  'select',
								'title' =>   $this->module->l('Tablet Layout', 'settings'),
								'options' => array('col-sm-1' => 'col-sm-1', 'col-sm-2' => 'col-sm-2', 'col-sm-3' => 'col-sm-3', 'col-sm-4' => 'col-sm-4', 'col-sm-5' => 'col-sm-5', 'col-sm-6' => 'col-sm-6', 'col-sm-7' => 'col-sm-7', 'col-sm-8' => 'col-sm-8', 'col-sm-9' => 'col-sm-9', 'col-sm-10' => 'col-sm-10', 'col-sm-11' => 'col-sm-11', 'col-sm-12' => 'col-sm-12'),
                'default' => 'col-sm-12',
								'desc'  =>   $this->module->l('Set the class of this column for tablets', 'settings'),
						),
						'xs_col'  =>  array(
								'type'  =>  'select',
								'title' =>   $this->module->l('Mobile Layout', 'settings'),
								'options' => array('col-xs-1' => 'col-xs-1', 'col-xs-2' => 'col-xs-2', 'col-xs-3' => 'col-xs-3', 'col-xs-4' => 'col-xs-4', 'col-xs-5' => 'col-xs-5', 'col-xs-6' => 'col-xs-6', 'col-xs-7' => 'col-xs-7', 'col-xs-8' => 'col-xs-8', 'col-xs-9' => 'col-xs-9', 'col-xs-10' => 'col-xs-10', 'col-xs-11' => 'col-xs-11', 'col-xs-12' => 'col-xs-12'),
                'default' => 'col-xs-12',
								'desc'  =>   $this->module->l('Set the class of this column for extra small devices', 'settings'),
						),
            'hidden_desktop' =>  array(
          			'type' => 'checkbox',
          			'title' =>   $this->module->l('Hidden on Desktop', 'settings'),
                'default' => 0,
                'desc' =>  $this->module->l('Switch to ‘Yes’ if you want to hide this row on desktop (smaller) displays', 'settings'),
          	),
            'hidden_tablet' =>  array(
          			'type' => 'checkbox',
          			'title' =>   $this->module->l('Hidden on Tablet', 'settings'),
                'default' => 0,
                'desc' =>  $this->module->l('Switch to ‘Yes’ if you want to hide this row on tablet (smaller) displays', 'settings'),
          	),
          	'hidden_mobile' =>  array(
          			'type' => 'checkbox',
          			'title' =>   $this->module->l('Hidden on Mobile', 'settings'),
                'default' => 0,
                'desc' =>  $this->module->l('Switch to ‘Yes’ if you want to hide this row on mobile (smaller) displays', 'settings'),
          	)
        )
    ),
    array(
        'title' => 'Advanced',
        'id'  => 'advanced',
        'content' => array(
            'margin' =>  array(
                'type' => 'padding',
                'title' =>  $this->module->l('Margin (px)', 'settings'),
                'default' => '0',
                'class' => 'screen-range',
                'desc' => $this->module->l('Margin for Column', 'settings'),
            ),
            'padding' =>  array(
                'type' => 'padding',
                'title' =>  $this->module->l('Padding (px)', 'settings'),
                'default' => '0',
                'class' => 'screen-range',
                'desc' => $this->module->l('Padding for Column', 'settings'),
            ),
          	'animation' =>  array(
          			'type' => 'select',
          			'title' =>  $this->module->l('Animation', 'settings'),
                'options' => $animation_names,
                'default' => '',
                'desc' => $this->module->l('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'settings'),
          	),
            'animation_duration'  =>  array(
            		'type'  =>  'range',
            		'title' =>  $this->module->l('Animation Duration (ms)', 'settings'),
                'default' => 0,
                'min' => 5,
                'max' => 3000,
                'desc'  =>  $this->module->l('Set how many milliseconds an animation will take to complete one cycle.', 'settings'),
          	),
            'animation_delay'  =>  array(
            		'type'  =>  'range',
            		'title' =>  $this->module->l('Animation Delay (ms)', 'settings'),
                'default' => 0,
                'min' => 0,
                'max' => 3000,
                'desc'  =>  $this->module->l('Set when the animation will start, this value is defined in milliseconds.', 'settings'),
          	),
        )
    ),
);
