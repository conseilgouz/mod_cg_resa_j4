/**
 * @module     CG Résa
 * Version			: 2.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2021 ConseilGouz. All Rights Reserved.
 * @author ConseilGouz 
**/
jQuery(document).ready(function($) {
 jQuery('#resasubmit').on('click',function() {
	 $wait = jQuery(this).attr('data-wait');
	 jQuery(this).text($wait);
 });
});

