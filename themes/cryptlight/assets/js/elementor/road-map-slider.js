(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/cryptlight_elementor_road_map_slider.default', function(){
	       
	        /* Add your code here */
	    	$('.road-map-slider').each( function() {
	    		var that 			= $(this);
	    		var road_map 		= that.find('.road-map-wrapper');
	    		var road_map_data 	= road_map.data('options') ? road_map.data('options') : {};

	    		var responsive_value = {
		            0:{
		              items:1,
		              nav:false
		            },
		            576:{
		              items:2
		            },
		            768:{
		              items:3
		            },
		            1024:{
		              items:4
		            },
		            1300:{
		              items:road_map_data.items
		            }
		        };
		        
		        road_map.owlCarousel({
		          autoWidth: road_map_data.autoWidth,
		          margin: 0,
		          items: road_map_data.items,
		          loop: road_map_data.loop,
		          autoplay: road_map_data.autoplay,
		          autoplayTimeout: road_map_data.autoplayTimeout,
		          center: road_map_data.center,
		          nav: road_map_data.nav,
		          dots: road_map_data.dots,
		          autoplayHoverPause: road_map_data.autoplayHoverPause,
		          slideBy: road_map_data.slideBy,
		          smartSpeed: road_map_data.smartSpeed,
		          navText:[
		          	'<i class="'+ road_map_data.nav_left +'"></i>',
		          	'<i class="'+ road_map_data.nav_right +'"></i>'
		          ],
		          responsive: responsive_value,
		        });
	    	});

        });


   });

})(jQuery);
