/*
Template: AdForest | Largest Classifieds Portal
Author: ScriptsBundle
Version: 1.0
Designed and Development by: ScriptsBundle
*/

var $ = jQuery.noConflict();


jQuery(document).ready(function($) {

        // Scroll to Top
		
		$( "#docs" ).tabs({
							show: { effect: "fade", duration: 400 },
							activate:function(event,ui){
								$('html,body').stop(true).animate({
									'scrollTop': $('.docs-content').offset().top
								}, 750, 'easeOutQuad');
							}
						});

		$(window).scroll(function() {
			if($(this).scrollTop() > 450) {
                $('#gotoTop').fadeIn();
			} else {
				$('#gotoTop').fadeOut();
			}
		});

		$('#gotoTop').click(function() {
			$('body,html').animate({scrollTop:0},400);
            return false;
		});

$('a.page-scroll').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 60
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
       
});