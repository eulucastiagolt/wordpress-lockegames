<?php
    $image = get_the_post_thumbnail_url(get_the_ID(), 'large');
    if (!$image) {
        $image = get_template_directory_uri() . '/assets/game-placeholder.svg';
    }
?>
<article class="group/card article-card rounded-2xl p-2">
    <a href="<?php the_permalink(); ?>">
        <div class="grid grid-cols-12 gap-2">
            <div class="col-span-3 p-0">
                <img class="rounded-2xl aspect-square object-cover" src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async">
            </div>
            <div class="flex flex-col justify-center col-span-9 p-0">
                <span class="meta"><?php echo esc_html(lockegames_relative_post_date()); ?></span>
                <h3 class="group-hover/card:text-purple line-clamp-2 text-lg/7">
                    <?php the_title(); ?>
                </h3>
                <?php if (!empty($args['excerpt'])): ?><p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 16)); ?></p><?php endif; ?>
            </div>
        </div>
    </a>
</article>
