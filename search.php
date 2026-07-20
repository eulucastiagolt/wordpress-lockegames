<?php
get_header();
?>
<main id="main-content" class="site-main" role="main">
    <header class="archive-header">
        <div class="container-xl">
            <span class="eyebrow"><?php esc_html_e('Busca', 'lockegames'); ?></span>
            <h1>
                <?php
                printf(
                    esc_html__('Resultados para: %s', 'lockegames'),
                    esc_html(get_search_query())
                );
                ?>
            </h1>
        </div>
    </header>

    <section class="archive-grid">
        <div class="container-xl">
            <div class="posts-list grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                <?php
                if (have_posts()) :
                    while (have_posts()) :
                        the_post();
                        get_template_part('template-parts/content', 'card', array('excerpt' => true));
                    endwhile;
                else :
                    ?>
                    <div class="empty-state"><?php esc_html_e('Nenhuma publicação encontrada.', 'lockegames'); ?></div>
                <?php endif; ?>
            </div>

            <?php
            the_posts_pagination(array(
                'mid_size' => 1,
                'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
                'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
                'class' => 'pagination',
            ));
            ?>
        </div>
    </section>
</main>
<?php
get_footer();
