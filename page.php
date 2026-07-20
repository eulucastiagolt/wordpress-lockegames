<?php
get_header();
?>
<main id="main-content" class="site-main" role="main">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article <?php post_class('max-w-4xl mx-auto'); ?>>
            <header class="archive-header mb-5">
                <h1><?php the_title(); ?></h1>
            </header>

            <div class="post-body-custom pb-10">
                <?php
                the_content();
                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Páginas:', 'lockegames'),
                    'after' => '</div>',
                ));
                ?>
            </div>
        </article>
    <?php endwhile; ?>
</main>
<?php
get_footer();
