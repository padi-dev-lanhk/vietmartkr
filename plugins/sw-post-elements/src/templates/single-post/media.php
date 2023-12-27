<?php 
global $post;
if ($settings['post_format_media'] == 'yes') {
    if (has_post_format('gallery')) {
        $gallery = [];
        if (has_block('gallery', $post->post_content)) {
            $post_blocks = parse_blocks($post->post_content);
            $ids = $post_blocks[0]['attrs'] ? $post_blocks[0]['attrs']['ids'] : '';
            for ($i=0; $i < count($post_blocks); $i++) { 
                if ($post_blocks[$i]['blockName'] == 'core/gallery') {
                    $gallery = $post_blocks[$i]['attrs'] ? $post_blocks[$i]['attrs']['ids'] : '';
                    break;
                }
            }
        } else {
            $gallery = get_post_gallery_images( $post );
        }
        if ($gallery) { ?>
            <div class="gallery-thumb">
                <?php the_post_thumbnail($settings['image_size']); ?>
            </div>
            <div class="gallery-slider swe-slider" data-slides_to_show="1" data-slides_to_show_tablet="1" data-slides_to_show_mobile="1" data-dots="yes">
                <?php foreach ($gallery as $swe_image) :
                    $swe_the_image = wp_get_attachment_image_src($swe_image, 'full-thumb');
                    $swe_the_caption = get_post_field('post_excerpt', $swe_image); ?>
                    <div><img src="<?php echo esc_url($swe_the_image[0]); ?>"
                        <?php if ($swe_the_caption) : ?>title="<?php echo esc_attr($swe_the_caption); ?>"<?php endif; ?> />
                    </div>
                <?php endforeach; ?>
            </div>
        <?php }
    } elseif (has_post_format('video') || has_post_format('audio')) {
        echo ent2ncr( get_first_video_embed(get_the_ID()) );

    } elseif (has_post_thumbnail()) { ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail($settings['image_size']); ?>
        </a>
    <?php }
} else {
    if (has_post_thumbnail()) { ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail($settings['image_size']); ?>
        </a>
    <?php }
}
