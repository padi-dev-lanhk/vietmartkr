			<div class="wrap_footer">
				<?php	echo apply_filters( 'cryptlight_render_footer', '' ); ?>
			</div>
			
		</div> <!-- Ova Wrapper -->	
		<?php wp_footer(); ?>
	</body><!-- /body -->
	<script>
		(function ($) {
			"use strict";
			$(document).ready(function() {
				$(".single").removeClass('site_dark');
				$(".single").removeClass('site_dark');
				$(".archive").removeClass('site_dark');
				$('.search').removeClass('site_dark');
				$(".menu-canvas button.menu-toggle").click(function () {
					$("html").addClass("open-menu");
				})
				$(".menu-canvas .site-overlay").click(function () {
					if($("html").hasClass('open-menu')){
						$("html").removeClass("open-menu");
					}
				})
				$(".menu-canvas .container-menu .close-menu").click(function () {
					if($("html").hasClass('open-menu')){
						$("html").removeClass("open-menu");
					}
				})
				 
				$('.list-related-post').owlCarousel({
					loop:true,
					margin:20,
					autoplay:true,
					autoplayTimeout:5000,
					autoplayHoverPause:false,
					nav:true,
					responsive:{
						0:{
							items:1
						},
						600:{
							items:2
						},
						1024:{
							items:3
						}
					}
				})
			})
			$(document).ready(function() {
					$('.stage--nav2 ul li a[href*=#]').bind('click', function(e) {
							e.preventDefault();
							var target = $(this).attr("href");
							$('html, body').stop().animate({
									scrollTop: $(target).offset().top
							}, 600, function() {
									location.hash = target;
							});

							return false;
					});
			});

			$(window).scroll(function() {
					var scrollDistance = $(window).scrollTop();
					$('.page-section').each(function(i) {
							if ($(this).position().top <= scrollDistance + 94) {
								console.log(i)
									$('.stage--nav2 ul li.active').removeClass('active');
									$('.stage--nav2 ul li').eq(i).addClass('active');
							}
					});
			}).scroll();
			})(jQuery);
	</script>
</html>