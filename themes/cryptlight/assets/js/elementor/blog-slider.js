(function($){
	"use strict";
	

	$(window).on('elementor/frontend/init', function () {
		
        elementorFrontend.hooks.addAction('frontend/element_ready/cryptlight_elementor_blog_slider.default', function(){
	       
	        /* Add your code here */
	    	$('.ova-blog-slide').each( function() {
	    		var that 		= $(this);
	    		var blog 		= that.find('.ova-wrapper-blog');
	    		var blog_data 	= blog.data('options') ? blog.data('options') : {};

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
		              items:2
		            },
		            1300:{
		              items:blog_data.items
		            }
		        };
		        
		        blog.owlCarousel({
		          autoWidth: blog_data.autoWidth,
		          margin: blog_data.margin,
		          items: blog_data.items,
		          loop: blog_data.loop,
		          autoplay: blog_data.autoplay,
		          autoplayTimeout: blog_data.autoplayTimeout,
		          center: blog_data.center,
		          nav: blog_data.nav,
		          dots: blog_data.dots,
		          autoplayHoverPause: blog_data.autoplayHoverPause,
		          slideBy: blog_data.slideBy,
		          smartSpeed: blog_data.smartSpeed,
		          navText:[
		          	'<i class="'+ blog_data.nav_left +'"></i>',
		          	'<i class="'+ blog_data.nav_right +'"></i>'
		          ],
		          responsive: responsive_value,
		        });
	    	});

        });
   });

})(jQuery);
