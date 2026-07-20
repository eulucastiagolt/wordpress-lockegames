<?php
get_header();

$paged = max(1, get_query_var('paged'), get_query_var('page'));
$archive_query_args = $GLOBALS['wp_query']->query_vars;
$archive_query_args['posts_per_page'] = 24;
$archive_query_args['paged'] = $paged;
$archive_query = new WP_Query($archive_query_args);
?>
<main id="main-content" class="site-main">
    <header class="archive-header my-4">
        <div class="container-xl">
            <span class="eyebrow">Explore por assunto</span>
            <h1>
                <?php single_term_title(); ?>
            </h1>
            <?php the_archive_description('<p>', '</p>'); ?>
        </div>
    </header>
    <section class="archive-grid">
        <div class="container-xl">
            <div class="posts-list grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                <?php
                    if ($archive_query->have_posts()):
                        while ($archive_query->have_posts()):
                            $archive_query->the_post();
                            get_template_part('template-parts/content', 'card', array('excerpt' => true));
                        endwhile;
                    else:
                ?>
                    <div class="empty-state">Ainda não há publicações nesta seção.</div>
                <?php endif; ?>
            </div>
            <?php
                $pagination = paginate_links(
                    [
                        'current' => $paged,
                        'mid_size' => 1,
                        'total' => $archive_query->max_num_pages,
                        'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                        'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
                    ]
                );
            ?>
            <?php if ($pagination) : ?>
                <nav class="navigation pagination" aria-label="<?php esc_attr_e('Posts', 'lockegames'); ?>">
                    <div class="nav-links">
                        <?php echo wp_kses_post($pagination); ?>
                    </div>
                </nav>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </section>
</main>
<?php get_footer(); ?>
