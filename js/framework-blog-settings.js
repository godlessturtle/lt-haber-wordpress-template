jQuery(document).ready(function( $ ) {

	"use strict";
	
	// preloader
	jQuery(window).load(function () {
		$('#preloader').fadeOut('slow', function () {
			$(this).remove();
		});
	});
	
	// blog list
	jQuery('.flexslider').flexslider({controlNav:true});
	jQuery(".video-responsive").fitVids();
	jQuery("#blog table" ).addClass( "table table-striped" );
	
	/* Closes the Responsive Menu on Menu Item Click*/
	$('.primary-menu li:not(.item-has-children) a').on('click', function() {
		$('.navbar-toggle:visible').click();
	});
	/*END MENU JS*/ 
		
});