<?php
get_header();
?>
<main id="main-content" class="site-main single-main" role="main">
    <?php
    while (have_posts()) :
        the_post();

        $categories = get_the_category();
        $primary_category = !empty($categories) ? $categories[0] : null;
        $category_name = $primary_category ? $primary_category->name : __('Artigo', 'lockegames');
        $category_url = $primary_category ? get_category_link($primary_category) : get_post_type_archive_link('post');
        $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $image_id = get_post_thumbnail_id(get_the_ID());
        $image_caption = $image_id ? wp_get_attachment_caption($image_id) : '';
        $description = get_the_excerpt();
        if (!$description) {
            $description = wp_trim_words(wp_strip_all_tags(get_the_content()), 34);
        }
        $description = preg_replace('/\s*(?:\[\s*(?:&hellip;|&#8230;|…|\.\.\.)\s*\]|(?:&hellip;|&#8230;|…|\.\.\.))\s*$/u', '', $description);
        if (!$image) {
            $image = get_template_directory_uri() . '/assets/game-placeholder.svg';
        }
        ?>
        <div class="container-xl post-breadcrumb-wrapper">
            <nav class="breadcrumb-nav" aria-label="<?php esc_attr_e('Breadcrumb', 'lockegames'); ?>">
                <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Início', 'lockegames'); ?></a>
                <span class="breadcrumb-separator" aria-hidden="true">/</span>
                <a href="<?php echo esc_url($category_url ?: home_url('/')); ?>"><?php echo esc_html($category_name); ?></a>
                <span class="breadcrumb-separator" aria-hidden="true">/</span>
                <span class="breadcrumb-current"><?php the_title(); ?></span>
            </nav>
        </div>

        <div class="container-xl layout-custom post-layout-custom">
            <figure class="post-featured-image">
                <img src="<?php echo esc_url($image); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async">
                <?php if ($image_caption) : ?>
                    <figcaption class="featured-caption"><?php echo esc_html($image_caption); ?></figcaption>
                <?php endif; ?>
            </figure>

            <header class="post-cover-content">
                <h1 class="post-title-custom"><?php the_title(); ?></h1>
                <?php if ($description) : ?>
                    <p class="post-excerpt"><?php echo esc_html($description); ?></p>
                <?php endif; ?>
                <div class="post-meta-custom">
                    <span class="post-author">
                        <?php echo get_avatar(get_the_author_meta('ID'), 34, '', get_the_author(), array('class' => 'author-avatar', 'loading' => 'lazy', 'extra_attr' => 'decoding="async"')); ?>
                        <span class="author-name"><?php the_author(); ?></span>
                    </span>
                    <span><i class="fa-regular fa-calendar"></i> <?php echo esc_html(lockegames_relative_post_date()); ?></span>
                    <?php if (!empty($categories)) : ?>
                        <span class="post-labels-custom hidden">
                            <?php foreach ($categories as $category) : ?>
                                <a href="<?php echo esc_url(get_category_link($category)); ?>"><?php echo esc_html($category->name); ?></a>
                            <?php endforeach; ?>
                        </span>
                    <?php endif; ?>
                </div>
            </header>

            <article <?php post_class('post-wrapper-custom'); ?>>
                <div class="post-body-custom">
                    <?php
                    the_content();
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . __('Páginas:', 'lockegames'),
                        'after' => '</div>',
                    ));
                    ?>
                </div>

                <?php $tags = get_the_tags(); ?>
                <?php if ($tags) : ?>
                    <div class="post-labels-custom post-footer-labels">
                        <?php foreach ($tags as $tag) : ?>
                            <a href="<?php echo esc_url(get_tag_link($tag)); ?>"><?php echo esc_html($tag->name); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <div class="post-share">
                    <span class="post-share-label"><?php esc_html_e('Compartilhe:', 'lockegames'); ?></span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Compartilhar no Facebook', 'lockegames'); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo rawurlencode(get_permalink()); ?>&text=<?php echo rawurlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Compartilhar no X', 'lockegames'); ?>"><i class="fa-brands fa-x-twitter"></i></a>
                    <a href="https://wa.me/?text=<?php echo rawurlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Compartilhar no WhatsApp', 'lockegames'); ?>"><i class="fa-brands fa-whatsapp"></i></a>
                    <a href="https://t.me/share/url?url=<?php echo rawurlencode(get_permalink()); ?>&text=<?php echo rawurlencode(get_the_title()); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e('Compartilhar no Telegram', 'lockegames'); ?>"><i class="fa-brands fa-telegram"></i></a>
                </div>

                <?php
                $related_args = array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'ignore_sticky_posts' => true,
                );
                if ($primary_category) {
                    $related_args['category__in'] = array($primary_category->term_id);
                }
                $related = new WP_Query($related_args);
                if ($related->have_posts()) :
                    ?>
                    <section class="related-posts-section" aria-labelledby="related-posts-title">
                        <h2 class="related-posts-title" id="related-posts-title"><?php esc_html_e('Leia Mais', 'lockegames'); ?></h2>
                        <div class="related-posts-grid">
                            <?php
                            while ($related->have_posts()) :
                                $related->the_post();
                                get_template_part('template-parts/content', 'card');
                            endwhile;
                            ?>
                        </div>
                    </section>
                    <?php
                endif;
                wp_reset_postdata();
                ?>

                <?php
                if (comments_open() || get_comments_number()) {
                    comments_template();
                }
                ?>
            </article>

            <aside class="post-sidebar-custom" aria-label="<?php esc_attr_e('Sidebar do artigo', 'lockegames'); ?>">
                <?php if (is_active_sidebar('post-sidebar')) : ?>
                    <?php dynamic_sidebar('post-sidebar'); ?>
                <?php else : ?>
                    <section class="widget post-sidebar-widget">
                        <h2 class="widget-title"><?php esc_html_e('Visto por outros Gamers', 'lockegames'); ?></h2>
                        <?php
                        $popular = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => 4,
                            'post__not_in' => array(get_the_ID()),
                            'ignore_sticky_posts' => true,
                            'orderby' => 'comment_count',
                        ));
                        if ($popular->have_posts()) :
                            ?>
                            <div class="sidebar-posts-list">
                                <?php
                                while ($popular->have_posts()) :
                                    $popular->the_post();
                                    $thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                    if (!$thumb) {
                                        $thumb = get_template_directory_uri() . '/assets/game-placeholder.svg';
                                    }
                                    ?>
                                    <a class="sidebar-post-link" href="<?php the_permalink(); ?>">
                                        <img src="<?php echo esc_url($thumb); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async">
                                        <span class="line-clamp-2"><?php the_title(); ?></span>
                                    </a>
                                    <?php
                                endwhile;
                                ?>
                            </div>
                            <?php
                        endif;
                        wp_reset_postdata();
                        ?>
                    </section>
                <?php endif; ?>
            </aside>
        </div>
    <?php endwhile; ?>
</main>
<?php
get_footer();
