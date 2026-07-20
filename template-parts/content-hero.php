<?php
    $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    if (!$image) { $image = get_template_directory_uri() . '/assets/game-placeholder.svg'; }
    [
        'post_container' => $post_container,
        'post_image' => $post_image,
        'post_image_container' => $post_image_container,
        'post_link' => $post_link,
        'post_title' => $post_title,
        'post_title_link' => $post_title_link,
        'post_content' => $post_content,
    ] = $args + [
        'post_container' => '',
        'post_image' => '',
        'post_image_container' => '',
        'post_link' => '',
        'post_title' => '',
        'post_title_link' => '',
        'post_content' => '',
    ];
?>
<article class="<?php echo $post_container; ?>">
    <a class="<?php echo $post_link; ?>" href="<?php the_permalink(); ?>">
        <div class="<?php echo $post_image_container; ?>">
            <img class="<?php echo $post_image; ?>" src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async">
        </div>
    <div class="<?php echo $post_content; ?>">
        <span class="text-xs text-pink font-bold"><?php echo esc_html(lockegames_relative_post_date()); ?></span>
        <h2 class="<?php echo $post_title; ?>">
            <?php the_title(); ?>
        </h2>
    </div>
    </a>
</article>
