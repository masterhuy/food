/**
* 2007-2020 PrestaShop
*
* Godzilla Ajax Search
*
*  @author    Godzilla <joommasters@gmail.com>
*  @copyright 2007-2020 Godzilla
*  @license   license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
*  @Website: https://www.godzillabuilder.com
*/


$(document).ready(function() {
	var timer;
	$( ".gdz-search-input" ).keyup(function() {
		clearTimeout(timer);
		var search_key = $(this).val();
		var _this = $(this);
		timer = setTimeout(function() {
			$.ajax({
				type: 'GET',
				url: prestashop['urls']['base_url'] + 'modules/gdz_ajaxsearch/ajax_search.php',
				headers: { "cache-control": "no-cache" },
				async: true,
				data: 'search_key=' + search_key,
				success: function(data)
				{
					$('.search-result-area').innerHTML = data;
				}
			}) .done(function( msg ) {
				$(_this).closest('.search-form').find('.search-result-area').html(msg);
			});
		}, 1000);
	})
	$('html').click(function() {
		$( ".search-result-area" ).html('');
	});

	$('.search-result-area').click(function(event){
		event.stopPropagation();
	});
});
