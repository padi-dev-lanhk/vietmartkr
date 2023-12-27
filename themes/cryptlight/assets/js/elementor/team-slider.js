(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/cryptlight_elementor_team_slider.default', function(){
	       
	    	/* Add your code here */
	    	$('.ova-team-slider').each( function() {
	    		var that 		= $(this);
	    		var team 		= that.find('.team-slider-wrapper');
	    		var team_data 	= team.data('options') ? team.data('options') : {};

	    		var responsive_value = {
		            0:{
		              items:1,
		              nav:false
		            },
		            576:{
		              items:1
		            },
		            768:{
		              items:2
		            },
		            1024:{
		              items:3
		            },
		            1300:{
		              items:team_data.items
		            }
		        };
		        
		        team.owlCarousel({
		          autoWidth: team_data.autoWidth,
		          margin: team_data.margin,
		          items: team_data.items,
		          loop: team_data.loop,
		          autoplay: team_data.autoplay,
		          autoplayTimeout: team_data.autoplayTimeout,
		          center: team_data.center,
		          nav: team_data.nav,
		          dots: false,
		          autoplayHoverPause: team_data.autoplayHoverPause,
		          slideBy: team_data.slideBy,
		          smartSpeed: team_data.smartSpeed,
		          navText:[
		          	'<i class="'+ team_data.nav_left +'"></i>',
		          	'<i class="'+ team_data.nav_right +'"></i>'
		          ],
		          responsive: responsive_value,
		        });
	    	});
	      

        });


   });

})(jQuery);
