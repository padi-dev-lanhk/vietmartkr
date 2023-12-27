(function($) {
	"use strict";
	
	$( '.autosearch-input' ).on( 'focus', function(){
		$( '.topsearch-entry' ).addClass( 'on' );
	}).on( 'focusout', function(){
		$('html').removeAttr('style');
		$( '.topsearch-entry' ).removeClass( 'on' );
	});
	
	/* 
	** Add Click On Ipad 
	*/
	$(window).on('resize',function(){
		var $width = $(this).width();
		if( $width < 1199 ){
			$( '.primary-menu .nav .dropdown-toggle'  ).each(function(){
				$(this).attr('data-toggle', 'dropdown');
			});
		}
	});
	
	/* Check variable if has swatches variation */
	if( $('body').hasClass( 'sw-wooswatches' ) ){
		$( '.sw-wooswatches .product-type-variable' ).each(function(){
			var h_swatches = $(this).find( '.sw-variation-wrapper' ).height() + 20;
			$(this).find( '.item-bottom' ).css( 'bottom', h_swatches );
		});
	}
	
	/*
	** Search on click
	*/
	$(".swe-woo-cart.cart-canvas").on('click', function(e){
		$(this).children('.input-toggle').prop('checked', true);
		 e.preventDefault();
	});
	
	
	$(".search-cate .icon-search").on('click', function(){
		$(".search-cate .top-form").fadeToggle();
		$('body').toggleClass("on-search");
		$('.search-cate .icon-search').toggleClass("on");
		$('html').toggleClass( 'overflow' );
	});
	

	$('#nav').onePageNav();	
	$(window).scroll(function () {
		$('#nav').removeClass("current");
	});


	$('.date-picker').datetimepicker({
		language: 'en',     
		pickDate: true,           
		pickTime: false,           
		pick12HourFormat: false,   
		pickSeconds: false, 
	});

	$('.date-picker2').datetimepicker({
		language: 'en',
		pickDate: false, 
		pickTime: true, 
		pick12HourFormat: true,
	});


	/*
	**  show menu mobile
	*/
	$( ".header-mobile-style1 .mobile-search .icon-search" ).on('click', function() {
	  $( ".header-mobile-style1 .mobile-search .top-form.top-search" ).slideToggle( "slow", function() {
	  });
	  $('.header-mobile-style1 .mobile-search .icon-search').toggleClass("closex");
	});
	
	$('.header-menu-categories .open-menu').on('click', function(){
		$('.main-menu').toggleClass("open");
	});
	
	$('.footer-mstyle1 .footer-menu .footer-search a').on('click', function(){
		$('.top-form.top-search').toggleClass("open");
	});
	
	$('.footer-mstyle1 .footer-menu .footer-more a').on('click', function(){
		$('.menu-item-hidden').toggleClass("open");
	});
	

	/*
	** js mobile
	*/
	$('.single-product .social-share .title-share').on('click', function(){
		$('.single-product .social-share').toggleClass("open");
	});
	$('.single-post .social-share .title-share').on('click', function(){
		$('.single-post .social-share').toggleClass("open");
	});

	$('.single-post .social-share.open .title-share').on('click', function(){
		$('.single-post .social-share').removeClass("open");
	});
	
	$('.product-nav-wrapper .filter-product').on('click', function(){
		$('.product-nav-wrapper .filter-mobile').toggleClass("open");
		$('.products-wrapper').toggleClass('show-modal');
	});
	
	$('.product-nav-wrapper .filter-product').on('click', function(){
		if( $( ".product-nav-wrapper .filter-product" ).not( ".filter-mobile" ) ){
			$('.products-wrapper').removeClass('show-modal');
		}	
	});
	
	$('.mobile-layout .back-history').on('click', function(){
		window.history.back();
	});
	

	/*add title to button*/
	$("a.compare").attr('title', custom_text.compare_text);
	$(".yith-wcwl-add-button a").attr('title', custom_text.wishlist_text);
	$("a.fancybox").attr('title', custom_text.quickview_text);
	$("a.add_to_cart_button").attr('title', custom_text.cart_text);
	
	$(document).ready(function(){
		$('[data-toggle="tooltip"]').tooltip(); 

		function goToByScroll(id) {
			id = id.replace("link", "");
			$('html,body').animate({ scrollTop: $("#" + id).offset().top - 65 }, 'slow');
		}

		$(".navigations > li > a").on('click',function(e) {
			e.preventDefault();
			goToByScroll($(this).attr("id"));
			$(".navigations > li li").removeClass("active");
		    //removing active class from other selected/default tab
		    $("li.active").removeClass("active");
		    $(this).parent().addClass("active");
		});

		
	});

	$(document).on('click',function(event) {
        //if you click on anything except the modal itself or the "open modal" link, close the modal
        if (!$(event.target).closest(".box-bottom").length) {
            $("body").find(".box-bottom").removeClass("open");
        }
    });
      /** Button viewed **/
    $(document).ready(function() {

        $(".sw-cart a.cart-contents").contents().unwrap();
        $(".tabcontent .top-minicart-icon").remove();
        $(".sw-cart .wrapp-minicart").remove();
        $('.box-bottom .block-title  .close-x').on('click', function() {
            $('.box-bottom').removeClass("open");
        });
        $('.box-bottom .open-box').on('click', function() {
            $('.box-bottom').addClass("open");
        });


        var tabLinks = document.querySelectorAll(".tablinks");
        var tabContent = document.querySelectorAll(".tabcontent");


        tabLinks.forEach(function(el) {
            el.addEventListener("click", openTabs);
        });


        function openTabs(el) {
            var btnTarget = el.currentTarget;
            var id = btnTarget.dataset.id;

            tabContent.forEach(function(el) {
                el.classList.remove("active");
            });

            tabLinks.forEach(function(el) {
                el.classList.remove("active");
            });

            document.querySelector("#" + id).classList.add("active");

            btnTarget.classList.add("active");
        }

    });
    
	/*
	** Product listing order hover
	*/
	$('ul.orderby.order-dropdown li ul').hide(); 
	$("ul.order-dropdown > li").each( function(){
		$(this).on('hover', function() {
			$('.products-wrapper').addClass('show-modal');
			$(this).find( '> ul' ).stop().fadeIn("fast");
		}, function() {
			$('.products-wrapper').removeClass('show-modal');
			$(this).find( '> ul' ).stop().fadeOut("fast");
		});
	});
	
	/*
	** Product listing select box
	*/
	
	$(".top-fill .button-filter").on('click', function(){
		$(".products-wrapper .above-product-widget").fadeToggle();
		$(".top-fill").toggleClass("closex");
	});
	
	/*
	** Quickview and single product slider
	*/
	$(document).ready(function(){
		/* 
		** Slider single product image
		*/
		$( '.product-images' ).each(function(){
			var $rtl 			= $('body').hasClass( 'rtl' );
			var $vertical		= $(this).data('vertical');
			var $img_slider 	= $(this).find('.product-responsive');
			var video_link 		= $(this).data('video');
			var $thumb_slider 	= $(this).find('.product-responsive-thumbnail' );
			var number_slider	= ( $vertical ) ? 5: 5;
			var number_mobile 	= ( $vertical ) ? 2: 4;
			
			$img_slider.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				fade: true,
				arrows: false,
			//	rtl: $rtl,
				asNavFor: $thumb_slider,
				infinite: false
			});
			$thumb_slider.slick({
				slidesToShow: number_slider,
				slidesToScroll: 1,
				asNavFor: $img_slider,
				arrows: true,
			//	rtl: $rtl,
				infinite: false,
				vertical: $vertical,
				verticalSwiping: $vertical,
				focusOnSelect: true,
				responsive: [
				{
					breakpoint: 480,
					settings: {
						slidesToShow: number_mobile    
					}
				},
				{
					breakpoint: 360,
					settings: {
						slidesToShow: 2    
					}
				}
				]
			});
			var el = $(this);
			setTimeout(function(){
				el.removeClass("loading");
				var height = el.find('.product-responsive').outerHeight();
				var target = el.find( ' .item-video' );
				target.css({'height': height,'padding-top': (height - target.outerHeight())/2 });

				var thumb_height = el.find('.product-responsive-thumbnail' ).outerHeight();
				var thumb_target = el.find( '.item-video-thumb' );
				thumb_target.css({ height: thumb_height,'padding-top':( thumb_height - thumb_target.outerHeight() )/2 });
			}, 1000);
			if( video_link != '' ) {
				$img_slider.append( '<button data-type="popup" class="featured-video-button fa fa-play" data-video="'+ video_link +'"></button>' );
				if( $( 'body' ).hasClass( 'single-product-style1' ) || $( 'body' ).hasClass( 'single-product-style2' ) ){
					$( '.woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image:first' ).prepend( '<button data-type="popup" class="featured-video-button style1" data-video="'+ video_link +'"></button>' );
				}
			}
		});
	});

	/*
	** Hover on mobile and tablet
	*/
	var mobileHover = function () {
		$('*').on('touchstart', function () {
			$(this).trigger('hover');
		}).on('touchend', function () {
			$(this).trigger('hover');
		});
	};
	mobileHover();
	
	/*
	** Menu hidden
	*/
	$('.product-categories').each(function(){
		var number	 = $(this).data( 'number' ) - 1;
		var lesstext = $(this).data( 'lesstext' );
		var moretext = $(this).data( 'moretext' );
		if( number > 0 ) {
			$(this).find( '> li:gt('+ number +')' ).hide().end();		
			if( $(this).children('li').length > number ){ 
				$(this).append(
					$('<li><a>'+ moretext +'   ...</a></li>')
					.addClass('showMore')
					.on('click',function(){
						if($(this).siblings(':hidden').length > 0){
							$(this).html( '<a>'+ lesstext +'   ...</a>' ).siblings(':hidden').show(400);
						}else{
							$(this).html( '<a>'+ moretext +'   ...</a>' ).show().siblings( ':gt('+ number +')' ).hide(400);
						}
					})
				);
			}
		}
		if( $(this).hasClass( 'accordion-categories' ) ){
			$(this).find( 'li.cat-parent' ).append( '<span class="child-category-more"></span>' );
		}
	});
	
	$(document).on( 'click', '.child-category-more', function(){
		$(this).parent().toggleClass( 'active' );
		$(this).parent().find( '> ul.children' ).toggle(200);
	});
	/* 
	** Fix accordion heading state 
	*/
	$('.accordion-heading').each(function(){
		var $this = $(this), $body = $this.siblings('.accordion-body');
		if (!$body.hasClass('in')){
			$this.find('.accordion-toggle').addClass('collapsed');
		}
	});	
	
	/*
	** Footer accordion
	*/
	
	$('.mobile-layout .cusom-menu-mobile .elementor-widget-container h5').append('<span class="icon-footer"></span>');

	$(".mobile-layout .cusom-menu-mobile .elementor-widget-container h5").each(function(){
		$(this).on('click', function(){
			$(this).parent().find("ul.menu").slideToggle();
		});
	});

	
	/*
	** Back to top
	**/
	$("#bakan-totop").hide();
	var wh = $(window).height();
	var whtml = $(document).height();
	$(window).scroll(function () {
		if ($(this).scrollTop() > whtml/10) {
			$('#bakan-totop').fadeIn();
		} else {
			$('#bakan-totop').fadeOut();
		}
	});
	
	$('#bakan-totop').on('click',function() {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});

	/* end back to top */

	 /*
	 ** Fix js 
	 */
	 $('.wpb_map_wraper').on('click', function () {
	 	$('.wpb_map_wraper iframe').css("pointer-events", "auto");
	 });

	 $( ".wpb_map_wraper" ).on('mouseleave', function() {
	 	$('.wpb_map_wraper iframe').css("pointer-events", "none"); 
	 });

	/*
	** Change Layout 
	*/
	$( window ).on('load',function() {	
		if( $( 'body' ).hasClass( 'tax-product_cat' ) || $( 'body' ).hasClass( 'post-type-archive-product' ) || $( 'body' ).hasClass( 'tax-dc_vendor_shop' ) ) {
			$('.grid-view').on('click',function(){
				$('.list-view').removeClass('active');
				$('.grid-view').addClass('active');
				jQuery("ul.products-loop").fadeOut(300, function() {
					$(this).removeClass("list").fadeIn(300).addClass( 'grid' );			
				});
			});
			
			$('.list-view').on('click',function(){
				$( '.grid-view' ).removeClass('active');
				$( '.list-view' ).addClass('active');
				$("ul.products-loop").fadeOut(300, function() {
					jQuery(this).addClass("list").fadeIn(300).removeClass( 'grid' );
				});
			});
			/* End Change Layout */
		} 
	});
		
	/*remove loading*/
	$(".sw-woo-tab").fadeIn(300, function() {
		var el = $(this);
		setTimeout(function(){
			el.removeClass("loading");
		}, 1000);
	});
	$(".responsive-slider").fadeIn(300, function() {
		var el = $(this);
		setTimeout(function(){
			el.removeClass("loading");
		}, 1000);
	});
	function sw_buynow_variation_product(){
		var element = $( '.single-product' );
		var target = $( '.single-product .variations_form' );
		var bt_addcart = target.find( '.single_add_to_cart_button' );
		var variation  = target.find( '.variation_id' ).val();
		var bt_buynow  = element.find( '.button-buynow' );
		var url = bt_buynow.data( 'url' );
		var qty = $('.single-product input.qty').val();
		if( typeof variation != 'undefined' ){
			if( variation == 0 ){
				bt_buynow.addClass( 'disabled' );
			}else{
				bt_buynow.removeClass( 'disabled' );
			}
			if( variation != '' ){
				bt_buynow.attr( 'href', url + '='+variation + '&quantity='+ qty );
			}else{
				bt_buynow.attr( 'href', url + '&quantity='+ qty );
			}
		}else{
			bt_buynow.attr( 'href', url + '&quantity='+ qty );
		}
	}
	$(window).on( 'change', function(){
		sw_buynow_variation_product();
	});
	$(document).ready(function(){
		sw_buynow_variation_product();
	});
}(jQuery));


/*
** Check comment form
*/
function submitform(){
	if(document.commentform.comment.value=='' || document.commentform.author.value=='' || document.commentform.email.value==''){
		alert('Please fill the required field.');
		return false;
	} else return true;
}
(function($){		
	$(".widget_nav_menu li.menu-compare a").on('hover', function() {
		$(this).css('cursor','pointer').attr('title', custom_text.compare_text);
	}, function() {
		$(this).css('cursor','auto');
	});
	$(".widget_nav_menu li.menu-wishlist a").on('hover', function() {
		$(this).css('cursor','pointer').attr('title', custom_text.wishlist_text);
	}, function() {
		$(this).css('cursor','auto');
	});
	

	$(window).scroll(function() {   
		if( $( 'body' ).hasClass( 'mobile-layout' ) ) {
			var target = $( '.mobile-layout #header-page' );
			var sticky_nav_mobile_offset = $(".mobile-layout #header-page").offset();
			if( sticky_nav_mobile_offset != null ){
				var sticky_nav_mobile_offset_top = sticky_nav_mobile_offset.top;
				var scroll_top = $(window).scrollTop();
				if ( scroll_top > sticky_nav_mobile_offset_top ) {
					$(".mobile-layout #header-page").addClass('sticky-mobile');
				}else{
					$(".mobile-layout #header-page").removeClass('sticky-mobile');
				}
			}
		}
	});
		
	/*
	** Ajax login
	*/
	$('form#login_ajax').on('submit', function(e){
		var target = $(this);		
		var usename = target.find( '#username').val();
		var pass 	= target.find( '#password').val();
		if( usename.length == 0 || pass.length == 0 ){
			target.find( '#login_message' ).addClass( 'error' ).html( custom_text.message );
			return false;
		}
		target.addClass( 'loading' );
		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: custom_text.ajax_url,
			headers: { 'api-key':target.find( '#woocommerce-login-nonce').val() },
			data: { 
				'action': 'bakan_custom_login_user', //calls wp_ajax_nopriv_ajaxlogin
				'username': target.find( '#username').val(), 
				'password': target.find( '#password').val(), 
				'security': target.find( '#woocommerce-login-nonce').val() 
			},
			success: function(data){
				target.removeClass( 'loading' );
				target.find( '#login_message' ).html( data.message );
				if (data.loggedin == false){
					target.find( '#username').css( 'border-color', 'red' );
					target.find( '#password').css( 'border-color', 'red' );
					target.find( '#login_message' ).addClass( 'error' );
				}
				if (data.loggedin == true){
					target.find( '#username').removeAttr( 'style' );
					target.find( '#password').removeAttr( 'style' );
					document.location.href = data.redirect;
					target.find( '#login_message' ).removeClass( 'error' );
				}
			}
		});
		e.preventDefault();
	});

	
})(jQuery);