<?php
/*
 * Single Product Rating
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     3.6.0
*/
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
	return;
}
if ( ! wc_review_ratings_enabled() ) {
	return;
}
	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();
?>

<div class="reviews-content" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
	<div class="star">
		<?php echo '<span style="width:'. ( $average*16 ) .'px"></span>'; ?>
		<div class="rating-hidden">
			<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'bakan' ), '<span itemprop="bestRating">', '</span>' ); ?>
			<?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'bakan' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
		</div>
	</div>
	<span class="review-number"><?php if ( comments_open() ) : ?><?php printf( _n( '%s Review', '%s Review(s)', $rating_count, 'bakan' ), '' . $rating_count . '' ); ?><?php endif; ?></span>
	<?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-write-review" rel="nofollow"><?php echo esc_html__('Add your Review','bakan');?></a><?php endif; ?>
</div>