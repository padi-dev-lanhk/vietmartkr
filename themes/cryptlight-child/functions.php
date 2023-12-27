<?php
/**
 * Setup Cryptlight Child Theme's textdomain.
 *
 * Declare textdomain for this child theme.
 * Translations can be filed in the /languages/ directory.
 */
function cryptlight_child_theme_setup() {
	load_child_theme_textdomain( 'cryptlight-child', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'cryptlight_child_theme_setup' );


add_action( 'wp_enqueue_scripts', 'cryptlight_enqueue_styles' );
function cryptlight_enqueue_styles() {
    $parenthandle = 'cryptlight-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}
function add_files(){
    wp_enqueue_script('indexs', get_stylesheet_directory_uri() . '/index.js');
}
add_action('wp_enqueue_scripts', 'add_files');

function crunchify_social_sharing_buttons($content) {
    global $post;
    if(is_singular() || is_home()){
    
        // Get current page URL 
        $crunchifyURL = urlencode(get_permalink());
 
        // Get current page title
        $crunchifyTitle = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
        // $crunchifyTitle = str_replace( ' ', '%20', get_the_title());
        
        // Get Post Thumbnail for pinterest
        $crunchifyThumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
 
        // Construct sharing URL without using any script
        $twitterURL = 'https://twitter.com/intent/tweet?text='.$crunchifyTitle.'&amp;url='.$crunchifyURL.'&amp;via=Crunchify';
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u='.$crunchifyURL;
        $googleURL = 'https://plus.google.com/share?url='.$crunchifyURL;
        $bufferURL = 'https://bufferapp.com/add?url='.$crunchifyURL.'&amp;text='.$crunchifyTitle;
        $linkedInURL = 'https://www.linkedin.com/shareArticle?mini=true&url='.$crunchifyURL.'&amp;title='.$crunchifyTitle;
 
        // Based on popular demand added Pinterest too
        $pinterestURL = 'https://pinterest.com/pin/create/button/?url='.$crunchifyURL.'&amp;media='.$crunchifyThumbnail[0].'&amp;description='.$crunchifyTitle;
 
        // Add sharing button at the end of page/page content
        $content .= '<!-- Implement your own superfast social sharing buttons without any JavaScript loading. No plugin required. Detailed steps here: https://crunchify.com/?p=7526 -->';
        $content .= '<div class="crunchify-social">';
        $content .= '<ul>';
        $content .= '<li><a class="crunchify-link crunchify-facebook" href="'.$facebookURL.'" target="_blank"><i aria-hidden="true" class="fab fa-facebook-f"></i></a></li>';
        $content .= '<li><a class="crunchify-link crunchify-linkedin" href="'.$linkedInURL.'" target="_blank"><i aria-hidden="true" class="fab fa-linkedin-in"></i></a></li>';
        $content .= '<li><a class="crunchify-link crunchify-googleplus" href="'.$googleURL.'" target="_blank"><i aria-hidden="true" class="far fa-envelope"></i></a></li>';
        $content .= '</ul>';
        $content .= '</div>';
        
        return $content;
    }else{
        // if not a post/page then don't include sharing button
        return $content;
    }
};
add_filter( 'the_content', 'crunchify_social_sharing_buttons');
function custom_related_posts( $content ) {
	global $post;
	$current_post_id = get_the_ID();
	$html = '';
	if ( is_singular( 'post' ) ) {
	//get the categories of the current post
	$cats = get_the_category( $current_post_id );
	$cat_array = array();
	foreach ( $cats as $key1 => $cat ) {
	$cat_array[ $key1 ] = $cat->slug;
	}
	//get the tags of the current post
	$tags = get_the_tags( $current_post_id );
	$tag_array = array();
	if(!empty($tag_array)) {
	foreach ( $tags as $key2 => $tag ) {
	$tag_array[ $key2 ] = $tag->slug;
	}
	}
	$related_posts = new WP_Query(
	array(
	'post_type' => 'post',
	'post_status' => 'publish',
	'tax_query' => array(
	'relation' => 'OR',
	array(
	'taxonomy' => 'category',
	'field' => 'slug',
	'terms' => $cat_array
	),
	array(
	'taxonomy' => 'post_tag',
	'field' => 'slug',
	'terms' => $tag_array
	)
	),
	'posts_per_page' => 3,
	'post__not_in' => array( $current_post_id ),
	'orderby' => array( 'title' => 'ASC', 'date' => 'DESC' )
	)
	);
	if ( $related_posts->have_posts() ) {
	$html .= '<div class="related-posts"><h3>TIN TỨC LIÊN QUAN</h3>';
	$html .= '<ul class="owl-carousel owl-theme list-related-post">';
	while ( $related_posts->have_posts() ) {
	$related_posts->the_post();
	$html .= '<li class="related-posts-link">';
	$html .= '<div class="thumbnail-post"><a rel="bookmark" href="';
	$html .= get_the_permalink();
	$html .= '">';
	if ( has_post_thumbnail( $post->ID ) ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
	$html .= '<img class="featured-image" src="' . esc_url( $image[0] ) . '">';
	}
	$html .= '</a>';
// 	$html .= '<div class="categories-post">';
// 	$categories = get_the_category();
// 	if ( ! empty( $categories ) ) {
	// $html .= '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
// 	$html .=  esc_html( $categories[0]->name );
// 	}
// 	$html .= '</div>';
// 	$html .= '</div>';
	$html .= '<h4 class="related-post-title"><a rel="bookmark" href="';
	$html .= get_the_permalink();
	$html .= '">'; 
	$html .= get_the_title() . '</a></h4>';
// 	$html .= '<div class="time-post">';
// 	$post_date = get_the_date( 'd/m/Y' );
// 	$html .= $post_date;
// 	$html .= '</div>';
	$html .= '</li>';
	}
	$html .= '</ul>';
	$html .= '</div>';

	wp_reset_postdata();
	} else {
	$html .= '<div class="related-posts">' . esc_html__( 'No related posts were found.', 'textdomain' ) . '</div>';
	}
	$content .= $html;
	}
	return $content;
	}
add_filter( 'the_content', 'custom_related_posts' );