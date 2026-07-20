<?php
get_header();
?>
<main id="main-content" class="site-main" role="main">
    <section class="archive-header">
        <div class="container-xl">
            <span class="eyebrow"><?php esc_html_e('Erro 404', 'lockegames'); ?></span>
            <h1><?php esc_html_e('Página não encontrada', 'lockegames'); ?></h1>
            <p><?php esc_html_e('O conteúdo que você tentou acessar não existe ou foi movido.', 'lockegames'); ?></p>
        </div>
    </section>

    <section class="archive-grid">
        <div class="container-xl">
            <div class="empty-state">
                <p><?php esc_html_e('Use a busca ou volte para a página inicial para continuar navegando.', 'lockegames'); ?></p>
                <?php get_search_form(); ?>
                <a class="button" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Voltar ao início', 'lockegames'); ?></a>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
