<?php
/**
 * View template for SWE Banner widget
 *
 * @package SWE\Templates
 * @copyright 2021 SW Elements. All rights reserved.
 */

$target = $settings['link']['is_external'] ? ' target="_blank"' : '';
$nofollow = $settings['link']['nofollow'] ? ' rel="nofollow"' : '';
?>
<div class="swe-wrap-banner swe-wrapper <?php echo $settings['effect'] ? 'effect-'.$settings['effect'] : null; ?>">
    <div class="swe-wrap-image">
        <?php if ($settings['image']['id']) {
            # code...
            echo wp_get_attachment_image($settings['image']['id'], $settings['image_size']); 
        } else { ?>
            <img src="<?php echo SWWE_PLUGIN_URI . 'assets/img/banner-placeholder.png' ?>" alt="">
        <?php } ?>
    </div>
    <?php
    if ( $settings['background_overlay'] == 'true' ) {
        echo '<div class="swe-bg-overlay"></div>';
    } ?>
    <div class="swe-wrap-content">
        <div>
            <?php $settings['title'] ? printf('<%s class="swe-title">%s</%s>', $settings['title_tag'], $settings['title'], $settings['title_tag']): ''; ?>
            <div class="swe-description">
                <?php $settings['description'] ? printf('<p>%s</p>', $settings['description']) : ''; ?>
                <?php if ($settings['button_text']) {
                    printf('<a class="swe-button" href="%s" %s %s>%s</a>', $settings['link']['url'], $target, $nofollow, $settings['button_text']);
                } ?>
            </div>
        </div>
    </div>
    <?php echo ($settings['link']['url']) ? '<a class="link-full-section" href="'.$settings['link']['url'].'" '.$target.' '.$nofollow.'></a>' : null; ?>
</div>
