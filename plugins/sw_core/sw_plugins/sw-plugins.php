<?php /** * Register Widgets */add_action( 'widgets_init', 'sw_plugin_register' );if( class_exists( 'WooCommerce' ) ) :	include_once( plugin_dir_path( __FILE__ ) . 'currency-converter/currency-converter.php' );		/*	** Product Meta	*/	add_action("admin_init", "post_init");	add_action( 'save_post', 'bakan_product_save_meta', 10, 1 );	function post_init(){		add_meta_box("bakan_product_meta", esc_html__( 'Recommend Product:', 'bakan' ), "bakan_product_meta", "product", "side", "high");		add_meta_box("sw_product_video_meta", esc_html__( 'Featured Video Product', 'sw_woocommerce' ), "sw_product_video_meta", "product", "side", "low");	}		function bakan_product_meta(){		global $post;		$recommend_product = get_post_meta( $post->ID, 'recommend_product', true );		$newproduct 	   = get_post_meta( $post->ID, 'newproduct', true );	?>		<p><label><b><?php esc_html_e( 'Recommend Product:', 'bakan' ) ?></b></label> &nbsp;&nbsp;		<input type="checkbox" name="recommend_product" value="1" <?php echo checked( $recommend_product, 1 ) ?> /></p>	<?php }	function sw_product_video_meta(){		global $post;		$featured_video_product = get_post_meta( $post->ID, 'featured_video_product', true );	?>		<div class="featured-image">			<?php if( $featured_video_product != '' ) : ?>			<div class="video-wrapper">				<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr( $featured_video_product ); ?>" frameborder="0" allowfullscreen></iframe>			</div>			<?php endif; ?>			<p><input type="text" name="featured_video_product" placeholder="<?php echo esc_attr__( 'Youtube Video ID', 'sw_woocommerce' ) ?>" value="<?php echo esc_attr( $featured_video_product ); ?>"/></p>		</div>	<?php 	}		function bakan_product_save_meta( $post_id ){		$meta_val = ( isset( $_POST['recommend_product'] ) ) ? $_POST['recommend_product'] : 0;		update_post_meta( $post_id, 'recommend_product', $meta_val );		if( isset( $_POST['featured_video_product'] ) ){			update_post_meta( $post_id, 'featured_video_product', $_POST['featured_video_product'] );		}			}	/*end product meta*/endif;function sw_plugin_register(){		if( !swg_options( 'ot_enable' ) ) :		register_widget( 'sw_ourteam_slider_widget' );	endif;		register_widget( 'sw_primary_menu' );	register_widget( 'sw_vertical_menu' );}if( !swg_options( 'ot_enable' ) ) :	include_once( plugin_dir_path( __FILE__ ) . 'sw-ourteam/sw-ourteam.php' );endif;if( !swg_options( 'portfolio_enable' ) ) :	include_once( plugin_dir_path( __FILE__ ) . 'sw-portfolio/portfolio.php' );endif;//include_once( plugin_dir_path( __FILE__ ) . 'sw-responsive-post/sw-resp-slider.php' );include_once( plugin_dir_path( __FILE__ ) . 'sw-page/sw-resp-page-listing.php' );include_once( plugin_dir_path( __FILE__ ) . 'sw-widgets.php' );/*** Override check*/function sw_core_override_check($path, $file ){	$paths = '';	if( locate_template( 'sw_core/'.$path . '/' . $file ) ){		$paths = get_template_part( '/sw_core/' . $path . '/' . $file );	}else{		$paths = SWPATH . 'sw_plugins/' . $path . '/themes/' . $file . '.php';	}	return $paths;}/*** Shortcode Blog*/$sw_blogcol = 0;function sw_blog( $atts, $content = '' ){	extract( shortcode_atts(		array(			'title' => '',			'description' =>'',			'category' => '',			'orderby' => '',			'order'	=> '',			'numberposts' => 5,			'columns' => 1,			'layout' => 'list'		), $atts )	);	global $sw_blogcol;	$sw_blogcol = $columns;	ob_start();?>	<div class="category-contents">		<?php if( $title != '' || $description != '' ) : ?>		<div class="swblog-title">			<?php echo ( $title != '' ) ? '<h2>' . $title . '</h2>' : ''; ?>			<?php echo ( $description != '' ) ? '<div class="swblog-description">' . $description . '</div>' : ''; ?>		</div>		<?php endif; ?>		<?php 			$blogclass = 'blog-content blog-content-'. $layout;			if( $layout == 'grid' ){				$blogclass .= ' row';			}		?>		<div class="<?php echo esc_attr( $blogclass ) ?>">		<?php 			$paged 	 = ( get_query_var('paged') ) ? get_query_var('paged') : 1;				$default = array( 				'post_type'	=> 'post',				'orderby'	=> $orderby,				'order'	=> $order,				'paged' => $paged,				'showposts'	=> $numberposts			);			if( $category != '' ) :				$default['tax_query'] = array(					array(						'taxonomy'	=> 'category',						'field'	=> 'slug',						'terms'	=> $category					)				);			endif;			$list = new WP_Query( $default );			while( $list->have_posts() ) : $list->the_post();				if( locate_template( 'templates/content-' . $layout . '.php' ) ) :					get_template_part( 'templates/content', $layout ); 				else:						echo '';			endif;			endwhile;			wp_reset_postdata();		?>		</div>		<?php if ($list->max_num_pages > 1) : ?>			<div class="pagination nav-pag pull-right">			<?php				echo paginate_links( array(					'base' => esc_url_raw( str_replace( 999999999, '%#%', get_pagenum_link( 999999999, false ) ) ),					'format' => '',					'current' => max( 1, get_query_var('paged') ),					'total' => $list->max_num_pages,					'end_size' => 2,					'mid_size' => 2,					'prev_text' => '<i class="fa fa-angle-left"></i>',					'next_text' => '<i class="fa fa-angle-right"></i>',					'type' => 'list',									) );			?>			</div>			<?php endif; ?>	</div><?php 	$content = ob_get_clean();	return $content;}add_shortcode( 'sw_blog', 'sw_blog' );