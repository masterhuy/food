<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla Slider
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

$query = "DROP TABLE IF EXISTS `_DB_PREFIX_gdz_slider_hook`;
CREATE TABLE `_DB_PREFIX_gdz_slider_hook` (
  `id_hook` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_slider_hook` (`id_hook`, `name`) VALUES
(1, 'displayWrapperTop'),
(2, 'displayWrapperBottom'),
(3, 'displayLeftColumn'),
(4, 'displayRightColumn'),
(5, 'displayHome');

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_slider_layer_style`;
CREATE TABLE `_DB_PREFIX_gdz_slider_layer_style` (
  `id_style` int(11) NOT NULL,
  `id_layer` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `data_style` varchar(10) NOT NULL,
  `data_font_weight` int(11) NOT NULL DEFAULT '400',
  `data_font_size` int(11) NOT NULL,
  `data_line_height` int(11) NOT NULL,
  `data_x` int(10) NOT NULL,
  `data_y` int(10) NOT NULL,
  `data_width` int(10) NOT NULL DEFAULT '100',
  `data_height` int(10) NOT NULL DEFAULT '50',
  `data_show` tinyint(1) NOT NULL
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_slider_layer_style` (`id_style`, `id_layer`, `type`, `data_style`, `data_font_weight`, `data_font_size`, `data_line_height`, `data_x`, `data_y`, `data_width`, `data_height`, `data_show`) VALUES
(19, 62, 'desktop', 'normal', 600, 60, 56, 235, 442, 641, 69, 1),
(21, 64, 'desktop', 'normal', 400, 32, 32, 235, 527, 100, 50, 1),
(272, 62, 'mobile', 'normal', 400, 20, 56, 107, 133, 348, 57, 1),
(274, 64, 'mobile', 'normal', 400, 12, 26, 108, 186, 81, 36, 1),
(335, 62, 'tablet', 'normal', 400, 48, 56, 263, 251, 655, 59, 1),
(337, 64, 'tablet', 'normal', 400, 16, 26, 262, 319, 100, 50, 1),
(377, 62, 'mobile2', 'normal', 400, 30, 40, 147, 202, 516, 56, 1),
(379, 64, 'mobile2', 'normal', 400, 12, 26, 152, 261, 100, 50, 1),
(380, 65, 'desktop', 'normal', 600, 60, 56, 255, 462, 641, 69, 1),
(381, 65, 'mobile', 'normal', 400, 24, 56, 126, 146, 348, 67, 1),
(382, 65, 'tablet', 'normal', 400, 48, 56, 424, 87, 655, 59, 1),
(383, 65, 'mobile2', 'normal', 400, 40, 40, 226, 79, 516, 56, 1),
(384, 66, 'desktop', 'normal', 400, 32, 32, 251, 537, 100, 50, 1),
(385, 66, 'mobile', 'normal', 400, 8, 26, 197, 232, 81, 36, 1),
(386, 66, 'tablet', 'normal', 400, 16, 26, 428, 275, 100, 50, 1),
(387, 66, 'mobile2', 'normal', 400, 8, 26, 314, 241, 100, 50, 1),
(388, 67, 'desktop', 'normal', 600, 60, 56, 275, 482, 641, 69, 1),
(389, 67, 'mobile', 'normal', 400, 24, 56, 146, 166, 348, 67, 1),
(390, 67, 'tablet', 'normal', 400, 48, 56, 444, 107, 655, 59, 1),
(391, 67, 'mobile2', 'normal', 400, 40, 40, 246, 99, 516, 56, 1),
(392, 68, 'desktop', 'normal', 400, 32, 32, 272, 550, 100, 50, 1),
(393, 68, 'mobile', 'normal', 400, 8, 26, 217, 252, 81, 36, 1),
(394, 68, 'tablet', 'normal', 400, 16, 26, 448, 295, 100, 50, 1),
(395, 68, 'mobile2', 'normal', 400, 8, 26, 334, 261, 100, 50, 1),
(396, 69, 'desktop', 'normal', 500, 22, 56, 268, 187, 639, 45, 1),
(397, 69, 'mobile', 'normal', 400, 16, 56, 41, 34, 348, 57, 1),
(398, 69, 'tablet', 'normal', 400, 18, 56, 178, 137, 653, 51, 1),
(399, 69, 'mobile2', 'normal', 400, 16, 16, 139, 45, 356, 31, 1),
(400, 70, 'desktop', 'normal', 600, 66, 66, 267, 253, 546, 61, 1),
(401, 70, 'mobile', 'normal', 400, 28, 28, 42, 118, 258, 32, 1),
(402, 70, 'tablet', 'normal', 400, 60, 60, 172, 249, 481, 41, 1),
(403, 70, 'mobile2', 'normal', 400, 28, 28, 136, 72, 295, 30, 1),
(404, 71, 'desktop', 'normal', 500, 22, 56, 1070, 187, 639, 43, 1),
(405, 71, 'mobile', 'normal', 400, 15, 15, 238, 52, 245, 27, 1),
(406, 71, 'tablet', 'normal', 400, 22, 22, 642, 170, 655, 59, 1),
(407, 71, 'mobile2', 'normal', 400, 16, 16, 416, 38, 514, 39, 1),
(408, 72, 'desktop', 'normal', 600, 66, 66, 1067, 251, 742, 64, 1),
(409, 72, 'mobile', 'normal', 400, 28, 28, 236, 83, 205, 31, 1),
(410, 72, 'tablet', 'normal', 400, 60, 60, 637, 199, 447, 60, 1),
(411, 72, 'mobile2', 'normal', 400, 28, 28, 416, 73, 257, 48, 1),
(412, 73, 'desktop', 'normal', 600, 22, 22, 1022, 190, 638, 51, 1),
(413, 73, 'mobile', 'normal', 400, 16, 56, 254, 26, 346, 44, 1),
(414, 73, 'tablet', 'normal', 400, 22, 22, 649, 129, 655, 59, 1),
(415, 73, 'mobile2', 'normal', 400, 16, 40, 414, 41, 121, 41, 1),
(416, 74, 'desktop', 'normal', 600, 66, 66, 1017, 253, 526, 60, 1),
(417, 74, 'mobile', 'normal', 400, 28, 28, 252, 79, 217, 38, 1),
(418, 74, 'tablet', 'normal', 400, 60, 60, 644, 160, 461, 59, 1),
(419, 74, 'mobile2', 'normal', 400, 28, 26, 413, 86, 216, 32, 1),
(424, 76, 'desktop', 'normal', 500, 15, 15, 266, 490, 120, 32, 1),
(425, 76, 'mobile', 'normal', 400, 14, 14, 15, 250, 120, 31, 1),
(426, 76, 'tablet', 'normal', 400, 14, 14, 175, 353, 107, 17, 1),
(427, 76, 'mobile2', 'normal', 400, 14, 14, 61, 243, 120, 31, 1),
(428, 77, 'desktop', 'normal', 600, 66, 66, 1069, 344, 742, 76, 1),
(429, 77, 'mobile', 'normal', 400, 28, 28, 238, 115, 198, 32, 1),
(430, 77, 'tablet', 'normal', 400, 60, 60, 639, 254, 410, 48, 1),
(431, 77, 'mobile2', 'normal', 400, 28, 28, 416, 107, 242, 48, 1),
(436, 79, 'desktop', 'normal', 600, 66, 66, 1017, 344, 489, 65, 1),
(437, 79, 'mobile', 'normal', 400, 28, 28, 251, 112, 205, 29, 1),
(438, 79, 'tablet', 'normal', 400, 60, 60, 648, 217, 328, 48, 1),
(439, 79, 'mobile2', 'normal', 400, 28, 26, 414, 117, 187, 30, 1),
(440, 80, 'desktop', 'normal', 600, 15, 15, 1017, 490, 133, 21, 1),
(441, 80, 'mobile', 'normal', 400, 14, 14, 260, 269, 133, 30, 0),
(442, 80, 'tablet', 'normal', 400, 24, 24, 647, 336, 133, 30, 1),
(443, 80, 'mobile2', 'normal', 400, 14, 14, 442, 242, 133, 30, 1),
(444, 81, 'desktop', 'normal', 600, 66, 66, 266, 345, 580, 65, 1),
(445, 81, 'mobile', 'normal', 400, 28, 28, 40, 88, 387, 24, 1),
(446, 81, 'tablet', 'normal', 400, 60, 60, 171, 189, 580, 46, 1),
(447, 81, 'mobile2', 'normal', 400, 28, 28, 136, 108, 578, 44, 1),
(448, 82, 'desktop', 'normal', 500, 15, 15, 1075, 456, 200, 50, 1),
(449, 82, 'mobile', 'normal', 400, 14, 14, 33, 50, 198, 48, 0),
(450, 82, 'tablet', 'normal', 400, 24, 24, 645, 363, 200, 50, 1),
(451, 82, 'mobile2', 'normal', 400, 14, 14, 0, 0, 200, 50, 1);

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_slider_slider`;
CREATE TABLE `_DB_PREFIX_gdz_slider_slider` (
  `id_slider` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `delay` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `trans` varchar(255) NOT NULL,
  `trans_in` varchar(255) NOT NULL,
  `trans_out` varchar(255) NOT NULL,
  `ease_in` varchar(255) NOT NULL,
  `ease_out` varchar(255) NOT NULL,
  `speed_in` int(11) NOT NULL,
  `speed_out` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `bg_animation` tinyint(1) NOT NULL,
  `bg_ease` varchar(255) NOT NULL,
  `end_animate` tinyint(1) NOT NULL,
  `full_width` tinyint(1) NOT NULL,
  `responsive` tinyint(1) NOT NULL,
  `max_width` int(11) NOT NULL,
  `max_height` int(11) NOT NULL,
  `mobile_height` int(11) NOT NULL,
  `tablet_height` int(11) NOT NULL DEFAULT '600',
  `mobile2_height` int(11) NOT NULL DEFAULT '500',
  `auto_change` tinyint(1) NOT NULL,
  `pause_hover` tinyint(1) NOT NULL,
  `show_pager` tinyint(1) NOT NULL,
  `show_control` tinyint(1) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `order` int(11) NOT NULL
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_slider_slider` (`id_slider`, `title`, `delay`, `x`, `y`, `trans`, `trans_in`, `trans_out`, `ease_in`, `ease_out`, `speed_in`, `speed_out`, `duration`, `bg_animation`, `bg_ease`, `end_animate`, `full_width`, `responsive`, `max_width`, `max_height`, `mobile_height`, `tablet_height`, `mobile2_height`, `auto_change`, `pause_hover`, `show_pager`, `show_control`, `active`, `order`) VALUES
(1, 'slider 1', 1000, 0, 0, 'fade', 'left', 'left', 'easeInCubic', 'easeOutExpo', 300, 0, 7000, 1, 'easeOutCubic', 1, 1, 1, 1920, 980, 420, 600, 500, 0, 0, 1, 1, 1, 1),
(2, 'custom slider home', 1000, 0, 0, 'fade', 'left', 'left', 'easeInCubic', 'easeOutExpo', 300, 0, 7000, 1, 'easeOutCubic', 1, 1, 1, 1920, 750, 220, 500, 220, 0, 0, 1, 1, 1, 1);

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_slider_slider_hook`;
CREATE TABLE `_DB_PREFIX_gdz_slider_slider_hook` (
  `id_slider` int(11) NOT NULL,
  `id_hook` int(11) NOT NULL
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_slider_slider_hook` (`id_slider`, `id_hook`) VALUES
(1, 5),
(2, 5);

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_slider_slider_lang`;
CREATE TABLE `_DB_PREFIX_gdz_slider_slider_lang` (
  `id_slider` int(10) NOT NULL,
  `id_lang` int(10) NOT NULL
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_slider_slider_lang` (`id_slider`, `id_lang`) VALUES
(1, 0),
(2, 0);

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_slider_slides`;
CREATE TABLE `_DB_PREFIX_gdz_slider_slides` (
  `id_slide` int(10) NOT NULL,
  `id_slider` int(11) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_suffix` varchar(100) NOT NULL,
  `bg_type` int(10) NOT NULL DEFAULT '1',
  `bg_image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `bg_color` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '#FFF',
  `slide_link` varchar(100) NOT NULL,
  `order` int(10) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1'
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_slider_slides` (`id_slide`, `id_slider`, `title`, `class_suffix`, `bg_type`, `bg_image`, `bg_color`, `slide_link`, `order`, `status`) VALUES
(7, 1, 'Home 1 - Slide 1', '', 1, '6494f64246d90eff78ca89f54d8dc3d7.jpg', '', '', 0, 1),
(9, 1, 'Home 1 - Slide 2', '', 1, '9def6aed19ad6d930e7f6f3b316043ed.jpg', '', '', 0, 1),
(10, 1, 'Home 1 - Slide 3', '', 1, '84163a29e62357af3a55bf3748a36f1e.jpg', '', '', 0, 1),
(11, 2, 'custom slide 1', '', 1, 'a77431496fc465764d26c6d0f18ff101.jpg', '', '', 0, 1),
(12, 2, 'custom slide 2', '', 1, '5b8b85f109e511d4ef673e47bea0dadd.jpg', '', '', 0, 1),
(13, 2, 'Custom Slide 3', '', 1, '09918345676829c4fa260270c0ae1237.jpg', '', '', 0, 1);

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_slider_slides_layers`;
CREATE TABLE `_DB_PREFIX_gdz_slider_slides_layers` (
  `id_layer` int(10) NOT NULL,
  `id_slide` int(10) NOT NULL,
  `data_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_class_suffix` varchar(50) NOT NULL,
  `data_fixed` int(10) NOT NULL DEFAULT '0',
  `data_delay` int(10) NOT NULL DEFAULT '1000',
  `data_time` int(10) NOT NULL DEFAULT '1000',
  `data_in` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'left',
  `data_out` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'right',
  `data_ease_in` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'linear',
  `data_ease_out` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'linear',
  `data_transform_in` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bounce',
  `data_transform_out` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'bounce',
  `data_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `data_image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `data_html` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `data_video` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `data_video_controls` int(10) NOT NULL DEFAULT '1',
  `data_video_muted` int(10) NOT NULL DEFAULT '0',
  `data_video_autoplay` int(10) NOT NULL DEFAULT '1',
  `data_video_loop` int(10) NOT NULL DEFAULT '1',
  `data_video_bg` int(10) NOT NULL DEFAULT '0',
  `data_color` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '#FFFFFF',
  `data_width` int(10) NOT NULL,
  `data_height` int(10) NOT NULL,
  `data_order` int(10) NOT NULL,
  `data_status` int(10) NOT NULL DEFAULT '1'
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_slider_slides_layers` (`id_layer`, `id_slide`, `data_title`, `data_class_suffix`, `data_fixed`, `data_delay`, `data_time`, `data_in`, `data_out`, `data_ease_in`, `data_ease_out`, `data_transform_in`, `data_transform_out`, `data_type`, `data_image`, `data_html`, `data_video`, `data_video_controls`, `data_video_muted`, `data_video_autoplay`, `data_video_loop`, `data_video_bg`, `data_color`, `data_width`, `data_height`, `data_order`, `data_status`) VALUES
(62, 7, 'New In', '', 0, 1000, 1700, 'top', 'bottom', 'linear', 'linear', 'bounce', 'bounce', 'text', '', 'New in', '', 0, 0, 0, 0, 0, '#ffffff', 641, 69, 0, 1),
(64, 7, 'Shop Now', '', 0, 2200, 2700, 'bottom', 'top', 'linear', 'linear', 'bounce', 'bounce', 'text', '', '<a href=\"#\" title=\"Shop now\">See new arrivals\n</a>', '', 0, 0, 0, 0, 0, '#ffffff', 100, 50, 0, 1),
(65, 9, 'New In', '', 0, 1000, 1700, 'top', 'bottom', 'linear', 'linear', 'bounce', 'bounce', 'text', '', 'New in', '', 0, 0, 0, 0, 0, '#ffffff', 641, 69, 0, 1),
(66, 9, 'Shop Now', '', 0, 2200, 2700, 'bottom', 'top', 'linear', 'linear', 'bounce', 'bounce', 'text', '', '<a href=\"#\" title=\"Shop now\">See new arrivals\n</a>', '', 0, 0, 0, 0, 0, '#ffffff', 100, 50, 0, 1),
(67, 10, 'New In', '', 0, 1000, 1700, 'top', 'bottom', 'linear', 'linear', 'bounce', 'bounce', 'text', '', 'New in', '', 0, 0, 0, 0, 0, '#ffffff', 641, 69, 0, 1),
(68, 10, 'Shop Now', '', 0, 2200, 2700, 'bottom', 'top', 'linear', 'linear', 'bounce', 'bounce', 'text', '', '<a href=\"#\" title=\"Shop now\">See new arrivals\n</a>', '', 0, 0, 0, 0, 0, '#ffffff', 100, 50, 0, 1),
(69, 11, 'New In', '', 0, 2300, 3000, 'fade', 'fade', 'linear', 'linear', 'slideInDown', 'slideInDown', 'text', '', 'Take off for brand new', '', 0, 0, 0, 0, 0, '#ffffff', 639, 45, 0, 1),
(70, 11, 'Modern Fashion', '', 0, 1000, 1700, 'fade', 'fade', 'linear', 'linear', 'fadeIn', 'fadeIn', 'text', '', 'Modern Fashion', '', 0, 0, 0, 0, 0, '#ffffff', 546, 61, 0, 1),
(71, 12, 'Don’t miss today featured deals', '', 0, 2000, 2700, 'fade', 'fade', 'linear', 'linear', 'fadeInDown', 'fadeInDown', 'text', '', 'Don’t miss today featured deals', '', 0, 0, 0, 0, 0, '#ffffff', 639, 43, 0, 1),
(72, 12, 'Get Up To 50% ', '', 0, 1000, 1700, 'fade', 'fade', 'linear', 'linear', 'fadeInRight', 'fadeInRight', 'text', '', 'Sale off To 50%', '', 0, 0, 0, 0, 0, '#ffffff', 742, 64, 0, 1),
(73, 13, 'Need it now', '', 0, 2000, 2700, 'fade', 'fade', 'linear', 'linear', 'fadeInDown', 'fadeInDown', 'text', '', 'Need it now', '', 0, 0, 0, 0, 0, '#ffffff', 638, 51, 0, 1),
(74, 13, 'Must-Haves For', '', 0, 1000, 1700, 'fade', 'fade', 'linear', 'linear', 'fadeInLeft', 'fadeInLeft', 'text', '', 'Must-Haves For', '', 0, 0, 0, 0, 0, '#ffffff', 526, 60, 0, 1),
(76, 11, 'Buy it now', '', 0, 2500, 3200, 'fade', 'fade', 'linear', 'linear', 'slideInUp', 'slideInUp', 'text', '', '<a href=\"#\" class=\"btn--buy\"><span>Buy It Now</span></a>', '', 0, 0, 0, 0, 0, '#000000', 120, 32, 0, 1),
(77, 12, 'Get Up To 50% ', '', 0, 1500, 2200, 'fade', 'fade', 'linear', 'linear', 'fadeInLeft', 'fadeInLeft', 'text', '', 'This Weekend', '', 0, 0, 0, 0, 0, '#ffffff', 742, 76, 0, 1),
(79, 13, 'The Season', '', 0, 1500, 2200, 'fade', 'fade', 'linear', 'linear', 'fadeInRight', 'fadeInRight', 'text', '', 'The Season', '', 0, 0, 0, 0, 0, '#ffffff', 489, 65, 0, 1),
(80, 13, 'Buy it now', '', 0, 2200, 2900, 'fade', 'fade', 'linear', 'linear', 'fadeInUp', 'fadeInUp', 'text', '', '<a href=\"#\" class=\"btn--buy\"><span>Buy It Now</span></a>', '', 0, 0, 0, 0, 0, '#FFFFFF', 133, 21, 0, 1),
(81, 11, 'Creates Your Style', '', 0, 1500, 2200, 'fade', 'fade', 'linear', 'linear', 'fadeIn', 'fadeIn', 'text', '', 'Creates Your Style', '', 0, 0, 0, 0, 0, '#ffffff', 580, 65, 0, 1),
(82, 12, 'Buy It Now', '', 0, 2500, 3200, 'fade', 'fade', 'linear', 'linear', 'slideInUp', 'slideInUp', 'text', '', '<a href=\"#\" class=\"btn--buy\"><span>Buy It Now</span></a>', '', 0, 0, 0, 0, 0, '#000000', 200, 50, 0, 1);

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_slider_slides_shop`;
CREATE TABLE `_DB_PREFIX_gdz_slider_slides_shop` (
  `id_slide` int(10) NOT NULL,
  `id_shop` int(10) NOT NULL
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_slider_slides_shop` (`id_slide`, `id_shop`) VALUES
(7, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1);

ALTER TABLE `_DB_PREFIX_gdz_slider_hook`
  ADD PRIMARY KEY (`id_hook`);

ALTER TABLE `_DB_PREFIX_gdz_slider_layer_style`
  ADD PRIMARY KEY (`id_style`);

ALTER TABLE `_DB_PREFIX_gdz_slider_slider`
  ADD PRIMARY KEY (`id_slider`);

ALTER TABLE `_DB_PREFIX_gdz_slider_slider_hook`
  ADD PRIMARY KEY (`id_slider`,`id_hook`);

ALTER TABLE `_DB_PREFIX_gdz_slider_slider_lang`
  ADD PRIMARY KEY (`id_slider`,`id_lang`);

ALTER TABLE `_DB_PREFIX_gdz_slider_slides`
  ADD PRIMARY KEY (`id_slide`);

ALTER TABLE `_DB_PREFIX_gdz_slider_slides_layers`
  ADD PRIMARY KEY (`id_layer`,`id_slide`);

ALTER TABLE `_DB_PREFIX_gdz_slider_slides_shop`
  ADD PRIMARY KEY (`id_slide`,`id_shop`);

ALTER TABLE `_DB_PREFIX_gdz_slider_layer_style`
  MODIFY `id_style` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=452;

ALTER TABLE `_DB_PREFIX_gdz_slider_slider`
  MODIFY `id_slider` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `_DB_PREFIX_gdz_slider_slides`
  MODIFY `id_slide` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `_DB_PREFIX_gdz_slider_slides_layers`
  MODIFY `id_layer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

ALTER TABLE `_DB_PREFIX_gdz_slider_slides_shop`
  MODIFY `id_slide` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
";
