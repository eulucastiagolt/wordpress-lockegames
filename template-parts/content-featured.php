<?php
$image = get_the_post_thumbnail_url(get_the_ID(), 'full');
if (!$image) { $image = get_template_directory_uri() . '/assets/game-placeholder.svg'; }
$categories = get_the_category();
?>
<article class="featured-story">
    <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async"><div class="featured-copy"><span class="eyebrow"><?php echo esc_html(!empty($categories) ? $categories[0]->name : 'Destaque'); ?></span><h1 id="hero-title"><?php the_title(); ?></h1><span class="meta"><?php echo esc_html(lockegames_relative_post_date()); ?></span></div></a>
</article>
