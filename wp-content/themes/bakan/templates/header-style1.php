<?php 
/* 
** Content Header
*/
$bakan_page_header  = get_post_meta( get_the_ID(), 'page_header_style', true );
$bakan_colorset  	= swg_options('scheme');
$bakan_logo 		= swg_options('sitelogo');
$sticky_menu 			= swg_options( 'sticky_menu' );
$bakan_menu_item 	= ( swg_options( 'menu_number_item' ) ) ? swg_options( 'menu_number_item' ) : 11;
$bakan_more_text 	= ( swg_options( 'menu_more_text' ) ) ? swg_options( 'menu_more_text' ) : esc_html__( 'See More', 'bakan' );
$bakan_less_text 	= ( swg_options( 'menu_less_text' ) ) ? swg_options( 'menu_less_text' ) : esc_html__( 'See Less', 'bakan' );
$bakan_menu_text 	= ( swg_options( 'menu_title_text' ) )	 ? swg_options( 'menu_title_text' )	: esc_html__( 'All Categories', 'bakan' );
$bakan_page_header  = ( get_post_meta( get_the_ID(), 'page_header_style', true ) != '' && ( is_single() || is_page() ) ) ? get_post_meta( get_the_ID(), 'page_header_style', true ) : swg_options('header_style'); 
?>
<header id="header" class="header header-style1">
	<div class="header-mid">
		<div class="container">
			<div class="row">
				<!-- Logo -->
				<div class="logo-header col-lg-2 col-md-2 col-sm-3 col-xs-12 pull-left">
					<div class="bakan-logo">
						<?php bakan_logo(); ?>
					</div>
				</div>
				<?php if( !swg_options( 'disable_search' ) ) : ?>
					<div class="sw_top swsearch-wrapper pull-right">
						<?php if( is_active_sidebar( 'search' ) && class_exists( 'sw_woo_search_widget' ) ): ?>
						<?php dynamic_sidebar( 'search' ); ?>
						<?php else : ?>
							<div class="widget bakan_top non-margin">
								<div class="widget-inner">
									<?php get_template_part( 'widgets/sw_top/searchcate' ); ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="header-bottom">
		<div class="container">
			<!-- Primary menu -->
			<?php if ( has_nav_menu('primary_menu') ) { ?>
				<div id="main-menu" class="main-menu pull-left">
					<nav id="primary-menu" class="primary-menu">
						<div class="mid-header clearfix">
							<div class="navbar-inner navbar-inverse">
								<?php
								$bakan_menu_class = 'nav nav-pills';
								if ( 'mega' == swg_options('menu_type') ){
									$bakan_menu_class .= ' nav-mega';
								} else $bakan_menu_class .= ' nav-css';
								?>
								<?php wp_nav_menu(array('theme_location' => 'primary_menu', 'menu_class' => $bakan_menu_class)); ?>
							</div>
						</div>
					</nav>
				</div>
			<?php } ?>
			<!-- /Primary navbar -->
		</div>
	</div>
</header>