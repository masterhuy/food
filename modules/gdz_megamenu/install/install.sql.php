<?php
/**
* 2007-2020 PrestaShop
*
* Godzilla MegaMenu for prestashop
*
*  @author    Godzilla<joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/

$query = "DROP TABLE IF EXISTS `_DB_PREFIX_gdz_megamenu`;
CREATE TABLE `_DB_PREFIX_gdz_megamenu` (
  `menu_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_shop` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_megamenu` (`menu_id`, `name`, `id_shop`, `active`) VALUES
(16, 'Vertical Menu', 1, 1),
(17, 'Mobile Menu', 1, 1),
(18, 'Top Menu', 1, 1);

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_megamenu_items`;
CREATE TABLE `_DB_PREFIX_gdz_megamenu_items` (
  `mitem_id` int(10) UNSIGNED NOT NULL,
  `menu_id` int(11) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(30) NOT NULL,
  `value` varchar(255) NOT NULL,
  `html_content` text NOT NULL,
  `active` tinyint(1) NOT NULL,
  `target` varchar(25) NOT NULL,
  `params` text NOT NULL,
  `ordering` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_megamenu_items` (`mitem_id`, `menu_id`, `parent_id`, `type`, `value`, `html_content`, `active`, `target`, `params`, `ordering`) VALUES
(381, 16, 0, 'product', '2', '', 1, '_self', '', 1),
(382, 16, 0, 'product', '3', '', 1, '_self', '', 2),
(383, 16, 381, 'product', '3', '', 1, '_self', '', 1),
(384, 16, 383, 'product', '2', '', 1, '_self', '', 1),
(385, 16, 0, 'product', '3', '', 1, '_self', '', 2),
(386, 16, 0, 'product', '4', '', 1, '_self', '', 3),
(387, 16, 0, 'product', '4', '', 1, '_self', '', 3),
(390, 17, 0, 'link', '', '', 1, '_self', '', 0),
(391, 17, 0, 'category', '12', '', 1, '_self', '', 1),
(394, 17, 0, 'link', '', '', 1, '_self', '', 3),
(424, 17, 0, 'gdz_blog-category', '2', '', 1, '_self', '', 2),
(436, 18, 0, 'link', '', '', 1, '_self', '{}', 0),
(437, 18, 0, 'category', '10', '', 1, '_self', '{\"sub\":{\"row\":[[{\"width\":\"12\",\"items\":[{\"item\":\"442\"},{\"item\":\"444\"},{\"item\":\"503\"}]}]]}}', 1),
(440, 18, 0, 'godzilla-page', '54', '', 1, '_self', '{\"align\":\"center\",\"sub\":{\"width\":\"800\",\"row\":[[{\"width\":\"3\",\"items\":[{\"item\":\"467\"},{\"item\":\"470\"},{\"item\":\"469\"},{\"item\":\"489\"},{\"item\":\"488\"},{\"item\":\"492\"},{\"item\":\"473\"},{\"item\":\"490\"}]},{\"width\":\"3\",\"items\":[{\"item\":\"495\"},{\"item\":\"476\"},{\"item\":\"491\"},{\"item\":\"468\"},{\"item\":\"471\"},{\"item\":\"493\"},{\"item\":\"472\"}]},{\"width\":\"3\",\"items\":[{\"item\":\"477\"},{\"item\":\"478\"},{\"item\":\"484\"},{\"item\":\"486\"},{\"item\":\"485\"},{\"item\":\"487\"}]},{\"width\":\"3\",\"items\":[{\"item\":\"496\"},{\"item\":\"479\"},{\"item\":\"482\"},{\"item\":\"483\"},{\"item\":\"481\"},{\"item\":\"480\"}]}],[{\"width\":\"6\",\"items\":[{\"item\":\"497\"}]},{\"width\":\"6\",\"items\":[{\"item\":\"498\"}]}]]}}', 2),
(441, 18, 0, 'gdz_blog-category', '2', '', 1, '_self', '{}', 3),
(442, 18, 437, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 0),
(444, 18, 437, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 1),
(445, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 0),
(446, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 3),
(447, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 7),
(448, 18, 503, 'product', '38', '', 1, '_self', '{\"title\":\"1\"}', 0),
(449, 18, 444, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 3),
(450, 18, 444, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 1),
(451, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 1),
(452, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 5),
(453, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 4),
(454, 18, 444, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 2),
(455, 18, 503, 'product', '58', '', 1, '_self', '{\"title\":\"1\"}', 3),
(456, 18, 503, 'product', '42', '', 1, '_self', '{\"title\":\"1\"}', 5),
(457, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 2),
(458, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 6),
(459, 18, 444, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 0),
(460, 18, 503, 'product', '47', '', 1, '_self', '{\"title\":\"1\"}', 1),
(461, 18, 503, 'product', '32', '', 1, '_self', '{\"title\":\"1\"}', 4),
(462, 18, 503, 'product', '36', '', 1, '_self', '{\"title\":\"1\"}', 2),
(465, 18, 0, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 4),
(467, 18, 440, 'link', '', '', 1, '_self', '{\"title\":\"1\",\"group\":\"1\"}', 2),
(468, 18, 440, 'godzilla-page', '39', '', 1, '_self', '{\"title\":\"1\"}', 1),
(469, 18, 440, 'godzilla-page', '45', '', 1, '_self', '{\"title\":\"1\"}', 2),
(470, 18, 440, 'godzilla-page', '50', '', 1, '_self', '{\"title\":\"1\"}', 3),
(471, 18, 440, 'godzilla-page', '41', '', 1, '_self', '{\"title\":\"1\"}', 4),
(472, 18, 440, 'godzilla-page', '46', '', 1, '_self', '{\"title\":\"1\"}', 5),
(473, 18, 440, 'godzilla-page', '44', '', 1, '_self', '{\"title\":\"1\"}', 6),
(476, 18, 440, 'godzilla-page', '47', '', 1, '_self', '{\"title\":\"1\"}', 7),
(477, 18, 440, 'link', '', '', 1, '_self', '{\"title\":\"1\",\"group\":\"1\"}', 3),
(478, 18, 440, 'godzilla-page', '31', '', 1, '_self', '{\"title\":\"1\"}', 0),
(479, 18, 440, 'godzilla-page', '35', '', 1, '_self', '{\"title\":\"1\"}', 5),
(480, 18, 440, 'godzilla-page', '30', '', 1, '_self', '{\"title\":\"1\"}', 8),
(481, 18, 440, 'godzilla-page', '36', '', 1, '_self', '{\"title\":\"1\"}', 9),
(482, 18, 440, 'godzilla-page', '55', '', 1, '_self', '{\"title\":\"1\"}', 6),
(483, 18, 440, 'godzilla-page', '56', '', 1, '_self', '{\"title\":\"1\"}', 7),
(484, 18, 440, 'godzilla-page', '57', '', 1, '_self', '{\"title\":\"1\"}', 1),
(485, 18, 440, 'godzilla-page', '58', '', 1, '_self', '{\"title\":\"1\"}', 3),
(486, 18, 440, 'godzilla-page', '60', '', 1, '_self', '{\"title\":\"1\"}', 2),
(487, 18, 440, 'godzilla-page', '59', '', 1, '_self', '{\"title\":\"1\"}', 4),
(488, 18, 440, 'godzilla-page', '42', '', 1, '_self', '{\"title\":\"1\"}', 8),
(489, 18, 440, 'godzilla-page', '62', '', 1, '_self', '{\"title\":\"1\"}', 9),
(490, 18, 440, 'godzilla-page', '63', '', 1, '_self', '{\"title\":\"1\"}', 10),
(491, 18, 440, 'godzilla-page', '61', '', 1, '_self', '{\"title\":\"1\"}', 11),
(492, 18, 440, 'godzilla-page', '48', '', 1, '_self', '{\"title\":\"1\"}', 12),
(493, 18, 440, 'godzilla-page', '64', '', 1, '_self', '{\"title\":\"1\"}', 13),
(495, 18, 440, 'link', '', '', 1, '_self', '{\"title\":\"1\",\"group\":\"1\"}', 14),
(496, 18, 440, 'link', '', '', 1, '_self', '{\"title\":\"1\",\"group\":\"1\"}', 15),
(497, 18, 440, 'html', 'html_content', '<p><img src=\"/prestashop17/befer2/img/cms/ban-2.jpg\" /></p>', 1, '_self', '{\"title\":\"0\"}', 16),
(498, 18, 440, 'html', 'html_content', '<p><img src=\"/prestashop17/befer2/img/cms/ban-3.jpg\" /></p>', 1, '_self', '{\"title\":\"0\"}', 17),
(499, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 8),
(500, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 9),
(501, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 10),
(502, 18, 442, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 11),
(503, 18, 437, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 2),
(504, 18, 444, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 4),
(505, 18, 444, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 5),
(506, 18, 444, 'link', '', '', 1, '_self', '{\"title\":\"1\"}', 6),
(507, 18, 437, 'link', '', '', 1, '_self', '', 3),
(508, 18, 437, 'link', '', '', 1, '_self', '', 4),
(509, 18, 437, 'link', '', '', 1, '_self', '', 5),
(511, 18, 441, 'gdz_blog-categories', 'gdz_blog_categories', '', 1, '_self', '', 1),
(512, 18, 511, 'link', '', '', 1, '_self', '', 1),
(513, 18, 511, 'link', '', '', 1, '_self', '', 2),
(514, 18, 511, 'link', '', '', 1, '_self', '', 3),
(515, 18, 441, 'gdz_blog-category', '1', '', 1, '_self', '', 5),
(516, 18, 515, 'link', '', '', 1, '_self', '', 1),
(517, 18, 515, 'link', '', '', 1, '_self', '', 2),
(518, 18, 515, 'link', '', '', 1, '_self', '', 3),
(519, 18, 441, 'gdz_blog-singlepost', '10', '', 1, '_self', '', 5),
(520, 18, 519, 'link', '', '', 1, '_self', '', 0),
(521, 18, 519, 'link', '', '', 1, '_self', '', 1),
(522, 18, 519, 'link', '', '', 1, '_self', '', 2);

DROP TABLE IF EXISTS `_DB_PREFIX_gdz_megamenu_items_lang`;
CREATE TABLE `_DB_PREFIX_gdz_megamenu_items_lang` (
  `mitem_id` int(11) NOT NULL,
  `id_lang` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `menulink` text NOT NULL
) ENGINE=_MYSQL_ENGINE_ DEFAULT CHARSET=utf8;

INSERT INTO `_DB_PREFIX_gdz_megamenu_items_lang` (`mitem_id`, `id_lang`, `name`, `menulink`) VALUES
(364, 1, 'sdsdsds', ''),
(364, 2, 'sdsdsds', ''),
(381, 1, 'Category Name 1', ''),
(381, 2, 'Category Name 1', ''),
(382, 1, 'Category Name 2', ''),
(382, 2, 'Category Name 2', ''),
(383, 1, 'Category level 2', ''),
(383, 2, 'Category level 2', ''),
(384, 1, 'Category level 3', ''),
(384, 2, 'Category level 3', ''),
(385, 1, 'Category Name 3', ''),
(385, 2, 'Category Name 3', ''),
(386, 1, 'Category Name 4', ''),
(386, 2, 'Category Name 4', ''),
(387, 1, 'Category Name 5', ''),
(387, 2, 'Category Name 5', ''),
(390, 1, 'Home', 'index.php'),
(390, 2, 'Home', 'index.php'),
(391, 1, 'Shop', ''),
(391, 2, 'Shop', ''),
(394, 1, 'Contact Us', 'index.php?controller=contact'),
(394, 2, 'Contact Us', 'index.php?controller=contact'),
(391, 4, 'Shop', ''),
(424, 1, 'Blog', '#'),
(424, 2, 'Blog', '#'),
(424, 3, 'Blog', '#'),
(387, 3, 'Category Name 5', ''),
(385, 3, 'Category Name 3', ''),
(386, 3, 'Category Name 4', ''),
(436, 1, 'Home', 'index.php'),
(436, 2, 'Home', '#'),
(436, 3, 'Home', '#'),
(437, 1, 'Shop', '#'),
(437, 2, 'Shop', '#'),
(437, 3, 'Shop', '#'),
(440, 1, 'Addons', '#'),
(440, 2, 'Pages', '#'),
(440, 3, 'Pages', '#'),
(441, 1, 'Blog', '#'),
(441, 2, 'Blog', '#'),
(441, 3, 'Blog', '#'),
(442, 1, 'Shop Layout', '#'),
(442, 2, 'Shop Layout', '#'),
(442, 3, 'Shop Layout', '#'),
(444, 1, 'Product Layout', '#'),
(444, 2, 'Product Layout', '#'),
(444, 3, 'Product Layout', '#'),
(445, 1, 'Left Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=left-sidebar'),
(445, 2, 'Left Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=left-sidebar'),
(445, 3, 'Left Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=left-sidebar'),
(446, 1, 'Grid - 2 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=2'),
(446, 2, 'Grid - 2 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=2'),
(446, 3, 'Grid - 2 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=3'),
(447, 1, 'Grid - 6 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=6&shop_layout=no-sidebar'),
(447, 2, 'Grid - 6 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=6&shop_layout=no-sidebar'),
(447, 3, 'Grid - 6 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=6&shop_layout=no-sidebar'),
(448, 1, 'Standard Product', ''),
(448, 2, 'Standard Product', '#'),
(448, 3, 'Standard Product', '#'),
(449, 1, 'Thumbs at Bottom', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-bottom'),
(449, 2, 'Thumbs at Bottom', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-bottom'),
(449, 3, 'Thumbs at Bottom', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-bottom'),
(450, 1, 'Right Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=right-sidebar'),
(450, 2, 'Right Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=right-sidebar'),
(450, 3, 'Right Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=right-sidebar'),
(451, 1, 'Right Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=right-sidebar'),
(451, 2, 'Right Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=right-sidebar'),
(451, 3, 'Right Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=right-sidebar'),
(452, 1, 'Grid - 4 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=4'),
(452, 2, 'Grid - 4 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=4'),
(452, 3, 'Grid - 4 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=4'),
(453, 1, 'Grid - 3 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=3'),
(453, 2, 'Grid - 3 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=3'),
(453, 3, 'Grid - 3 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=3'),
(454, 1, 'No Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=no-sidebar'),
(454, 2, 'No Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=no-sidebar'),
(454, 3, 'No Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=no-sidebar'),
(455, 1, 'Product Color Swatch', '#'),
(455, 2, 'Product Color Swatch', '#'),
(455, 3, 'Product Color Swatch', '#'),
(456, 1, 'Product with Video', '#'),
(456, 2, 'Product with Video', '#'),
(456, 3, 'Product with Video', '#'),
(457, 1, 'No Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=no-sidebar'),
(457, 2, 'No Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=no-sidebar'),
(457, 3, 'No Sidebar', 'index.php?id_category=12&controller=category&id_lang=1&shop_layout=no-sidebar'),
(458, 1, 'Grid - 5 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=5&shop_layout=no-sidebar'),
(458, 2, 'Grid - 5 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=5&shop_layout=no-sidebar'),
(458, 3, 'Grid - 5 Columns', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=5&shop_layout=no-sidebar'),
(459, 1, 'Left Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=left-sidebar'),
(459, 2, 'Left Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=left-sidebar'),
(459, 3, 'Left Sidebar', 'index.php?id_product=38&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_page_layout=left-sidebar'),
(460, 1, 'Virtual Product', '#'),
(460, 2, 'Virtual Product', '#'),
(460, 3, 'Virtual Product', '#'),
(461, 1, 'Product with Custom Tab', '#'),
(461, 2, 'Product with Custom Tab', '#'),
(461, 3, 'Product with Custom Tab', '#'),
(462, 1, 'Pack of Products', '#'),
(462, 2, 'Pack of Products', '#'),
(462, 3, 'Pack of Products', '#'),
(465, 1, 'Contact Us', 'index.php?controller=contact'),
(465, 2, 'Contact Us', 'index.php?controller=contact'),
(465, 3, 'Contact Us', 'index.php?controller=contact'),
(467, 1, 'Addons', '#'),
(467, 2, 'Addons', '#'),
(467, 3, 'Addons', '#'),
(468, 1, 'Testimonials', '#'),
(468, 2, 'Testimonials', '#'),
(468, 3, 'Testimonials', '#'),
(469, 1, 'Image Carousel', '#'),
(469, 2, 'Image Carousel', '#'),
(469, 3, 'Image Carousel', '#'),
(470, 1, 'Images', '#'),
(470, 2, 'Images', '#'),
(470, 3, 'Images', '#'),
(471, 1, 'Video', '#'),
(471, 2, 'Video', '#'),
(471, 3, 'Video', '#'),
(472, 1, 'Accordion & Tab', '#'),
(472, 2, 'Accordion & Tab', '#'),
(472, 3, 'Accordion & Tab', '#'),
(473, 1, 'Heading & Text', '#'),
(473, 2, 'Heading & Text', '#'),
(473, 3, 'Heading & Text', '#'),
(476, 1, 'Slideshow', '#'),
(476, 2, 'Slideshow', '#'),
(476, 3, 'Slideshow', '#'),
(477, 1, 'Shop Addons', '#'),
(477, 2, 'Shop Addons', '#'),
(477, 3, 'Shop Addons', '#'),
(478, 1, 'Featured Products', '#'),
(478, 2, 'Featured Products', '#'),
(478, 3, 'Featured Products', '#'),
(479, 1, 'Category Products', '#'),
(479, 2, 'Category Products', '#'),
(479, 3, 'Category Products', '#'),
(480, 1, 'HotDeal & FlashSale', '#'),
(480, 2, 'HotDeal & FlashSale', '#'),
(480, 3, 'HotDeal & FlashSale', '#'),
(481, 1, 'Countdown', '#'),
(481, 2, 'Countdown', '#'),
(481, 3, 'Countdown', '#'),
(482, 1, 'Category Tab', '#'),
(482, 2, 'Category Tab', '#'),
(482, 3, 'Category Tab', '#'),
(483, 1, 'Product Tab', '#'),
(483, 2, 'Product Tab', '#'),
(483, 3, 'Product Tab', '#'),
(484, 1, 'Latest Products', '#'),
(484, 2, 'Latest Products', '#'),
(484, 3, 'Latest Products', '#'),
(485, 1, 'OnSale Products', '#'),
(485, 2, 'OnSale Products', '#'),
(485, 3, 'OnSale Products', '#'),
(486, 1, 'Top-Seller Products', '#'),
(486, 2, 'Top-Seller Products', '#'),
(486, 3, 'Top-Seller Products', '#'),
(487, 1, 'Special Products', '#'),
(487, 2, 'Special Products', '#'),
(487, 3, 'Special Products', '#'),
(488, 1, 'Map', '#'),
(488, 2, 'Map', '#'),
(488, 3, 'Map', '#'),
(489, 1, 'Banners', '#'),
(489, 2, 'Banners', '#'),
(489, 3, 'Banners', '#'),
(490, 1, 'Alert Box', '#'),
(490, 2, 'Alert Box', '#'),
(490, 3, 'Alert Box', '#'),
(491, 1, 'Service Box', '#'),
(491, 2, 'Service Box', '#'),
(491, 3, 'Service Box', '#'),
(492, 1, 'Content Popup', '#'),
(492, 2, 'Content Popup', '#'),
(492, 3, 'Content Popup', '#'),
(493, 1, 'Icon Box', '#'),
(493, 2, 'Icon Box', '#'),
(493, 3, 'Icon Box', '#'),
(495, 1, 'Addons', '#'),
(495, 2, 'Addons', '#'),
(495, 3, 'Addons', '#'),
(496, 1, 'Shop Addons', '#'),
(496, 2, 'Shop Addons', '#'),
(496, 3, 'Shop Addons', '#'),
(497, 1, 'banner-1', '#'),
(497, 2, 'banner-1', '#'),
(497, 3, 'banner-1', '#'),
(498, 1, 'banner-2', '#'),
(498, 2, 'banner-2', '#'),
(498, 3, 'banner-2', '#'),
(499, 1, 'Grid - 1-2-1-2', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=1-2-1-2'),
(499, 2, 'Grid - 1-2-1-2', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=1-2-1-2'),
(499, 3, 'Grid - 1-2-1-2', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=1-2-1-2'),
(500, 1, 'Grid - 2-1-2-1', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=2-1-2-1'),
(500, 2, 'Grid - 2-1-2-1', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=2-1-2-1'),
(500, 3, 'Grid - 2-1-2-1', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=2-1-2-1'),
(501, 1, 'Grid - 1-3-1-3', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=1-3-1-3'),
(501, 2, 'Grid - 1-3-1-3', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=1-3-1-3'),
(501, 3, 'Grid - 1-3-1-3', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=1-3-1-3'),
(502, 1, 'Grid - 3-1-3-1', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=3-1-3-1'),
(502, 2, 'Grid - 3-1-3-1', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=3-1-3-1'),
(502, 3, 'Grid - 3-1-3-1', 'index.php?id_category=12&controller=category&id_lang=1&shop_grid_column=3-1-3-1'),
(503, 1, 'Product Type', '#'),
(503, 2, 'Product Type', '#'),
(503, 3, 'Product Type', '#'),
(504, 1, 'Thumbs at Left', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-left'),
(504, 2, 'Thumbs at Left', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-left'),
(504, 3, 'Thumbs at Left', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-left'),
(505, 1, 'Thumbs at Right', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-right'),
(505, 2, 'Thumbs at Right', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-right'),
(505, 3, 'Thumbs at Right', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-right'),
(506, 1, 'Thumbs Gallery', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-gallery'),
(506, 2, 'Thumbs Gallery', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-gallery'),
(506, 3, 'Thumbs Gallery', 'index.php?id_product=38&id_product_attribute=284&rewrite=paper-straw-shopper&controller=product&id_lang=1&product_content_layout=thumbs-gallery'),
(507, 1, 'Cart Page', 'index.php?controller=cart&action=show'),
(507, 2, 'Cart Page', 'index.php?controller=cart&action=show'),
(507, 3, 'Cart Page', 'index.php?controller=cart&action=show'),
(508, 1, 'Checkout', 'index.php?controller=order'),
(508, 2, 'Checkout', '#'),
(508, 3, 'Checkout', '#'),
(509, 1, 'Account Page', 'index.php?controller=my-account'),
(509, 2, 'Account Page', '#'),
(509, 3, 'Account Page', '#'),
(511, 1, 'Categories', '#'),
(511, 2, 'Categories', '#'),
(511, 3, 'Categories', '#'),
(512, 1, 'Left Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=left'),
(512, 2, 'Left Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=left'),
(512, 3, 'Left Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=left'),
(513, 1, 'Right Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=right'),
(513, 2, 'Right Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=right'),
(513, 3, 'Right Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=right'),
(514, 1, 'No Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=no'),
(514, 2, 'No Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=no'),
(514, 3, 'No Sidebar', 'index.php?fc=module&module=gdz_blog&controller=categories&page_layout=no'),
(515, 1, 'SIngle Category', '#'),
(515, 2, 'SIngle Category', '#'),
(515, 3, 'SIngle Category', '#'),
(516, 1, 'Left Sidebar', 'index.php?fc=module&module=gdz_blog&category_id=2&controller=category&id_lang=1&page_layout=left'),
(516, 2, 'Left Sidebar', '#'),
(516, 3, 'Left Sidebar', '#'),
(517, 1, 'Right Sidebar', 'index.php?fc=module&module=gdz_blog&category_id=2&controller=category&id_lang=1&page_layout=right'),
(517, 2, 'Right Sidebar', '#'),
(517, 3, 'Right Sidebar', '#'),
(518, 1, 'No Sidebar', 'index.php?fc=module&module=gdz_blog&category_id=2&controller=category&id_lang=1&page_layout=no'),
(518, 2, 'No Sidebar', '#'),
(518, 3, 'No Sidebar', '#'),
(519, 1, 'Single Post', '#'),
(519, 2, 'Single Post', '#'),
(519, 3, 'Single Post', '#'),
(520, 1, 'Left Sidebar', 'index.php?fc=module&module=gdz_blog&category_slug=blog&post_id=10&controller=post&id_lang=1&page_layout=left'),
(520, 2, 'Left Sidebar', '#'),
(520, 3, 'Left Sidebar', '#'),
(521, 1, 'Right Sidebar', 'index.php?fc=module&module=gdz_blog&category_slug=blog&post_id=10&controller=post&id_lang=1&page_layout=right'),
(521, 2, 'Right Sidebar', '#'),
(521, 3, 'Right Sidebar', '#'),
(522, 1, 'No Sidebar', 'index.php?fc=module&module=gdz_blog&category_slug=blog&post_id=10&controller=post&id_lang=1&page_layout=no'),
(522, 2, 'No Sidebar', '#'),
(522, 3, 'No Sidebar', '#'),
(390, 3, 'Home', 'index.php'),
(391, 3, 'Shop', '#'),
(394, 3, 'Contact Us', 'index.php?controller=contact');

ALTER TABLE `_DB_PREFIX_gdz_megamenu`
  ADD PRIMARY KEY (`menu_id`);

ALTER TABLE `_DB_PREFIX_gdz_megamenu_items`
  ADD PRIMARY KEY (`mitem_id`);

ALTER TABLE `_DB_PREFIX_gdz_megamenu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `_DB_PREFIX_gdz_megamenu_items`
  MODIFY `mitem_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=523;
";
