<?php
/**
 * View template for SWE Banner widget
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$target = $settings['link']['is_external'] ? 'target="_blank"' : '';
$nofollow = $settings['link']['nofollow'] ? 'rel="nofollow"' : '';
?>
<div class="swe-wrap-banner swe-wrapper <?php echo esc_attr($settings['effect'] ? 'effect-'.$settings['effect'] : null); ?>">
    <div class="swe-wrap-image">
        <?php if ($settings['image']['id']) {
            echo wp_get_attachment_image($settings['image']['id'], $settings['image_size']); 
        } else { ?>
            <img src="<?php echo esc_url( SWPE_PLUGIN_URI . 'assets/img/banner-placeholder.png' ); ?>" alt="">
        <?php } ?>
    </div>
    <?php
    if ( $settings['background_overlay'] == 'true' ) { ?>
        <div class="swe-bg-overlay"></div>
    <?php } ?>
    <div class="swe-wrap-content">
        <div>
            <?php if ($settings['title']) { ?>
                <h3 class="swe-title"><?php echo esc_html($settings['title']); ?></h3>
            <?php } ?>
            <div class="swe-description">
                <?php if($settings['description']) { ?>
                    <p><?php echo esc_html($settings['description']); ?></p>
                <?php } ?>
                <?php if ($settings['button_text']) {
                    printf( '<a class="swe-button" href="%s" %s %s>%s</a>', esc_url($settings['link']['url']), esc_attr($target), esc_attr($nofollow), esc_html($settings['button_text']) );
                } ?>
            </div>
        </div>
    </div>
    <?php if ($settings['link']['url']) {
        printf('<a class="link-full-section" href="%s" %s %s></a>', esc_url($settings['link']['url']), ent2ncr($target), ent2ncr($nofollow) );
    } ?>
</div>
