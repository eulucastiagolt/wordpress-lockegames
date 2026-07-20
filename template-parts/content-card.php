<?php
    $image = get_the_post_thumbnail_url(get_the_ID(), 'large');

    if (!$image) {
        $image = get_template_directory_uri() . '/assets/game-placeholder.svg';    
    }

    [
        'class' => $class,
    ] = $args + ['class' => '']
    
?>
<article class="group/card article-card rounded-2xl<?php echo ' ' . $class; ?>">
    <a href="<?php the_permalink(); ?>">
        <div class="">
            <img class="aspect-video rounded-t-2xl" src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async">
        </div>
        <div class="p-4">
            <span class="meta"><?php echo esc_html(lockegames_relative_post_date()); ?></span>
            <h3 class="group-hover/card:text-purple line-clamp-2 text-lg/7">
                <?php the_title(); ?>
            </h3>
            <?php if (!empty($args['excerpt'])) : ?>
                <p>
                    <?php echo esc_html(wp_trim_words(get_the_excerpt(), 16)); ?>
                </p>
            <?php endif; ?>
        </div>
    </a>
</article>
