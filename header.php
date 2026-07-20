<?php if (!defined('ABSPATH')) { exit; } ?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?><a class="skip-link" href="#main-content">Pular para o conteúdo</a>
<header class="site-header" role="banner">
    <div class="header-inner container-xl">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="screen-reader-text">Abrir menu</span><span aria-hidden="true">☰</span></button>
        <div class="header-logo"><a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Locke Games, início"><img class="header-logo-image" src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo-locke-games-white.svg'); ?>" alt="Locke Games" loading="lazy" decoding="async"></a></div>
        <nav class="nav-menu" aria-label="Navegação principal">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_id' => 'primary-menu',
                'menu_class' => 'main-nav',
                'depth' => 3,
            ));
            ?>
        </nav>
        <div class="header-icons">
            <form class="header-search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <label class="screen-reader-text" for="header-search">Buscar</label>
                <input id="header-search" name="s" type="search" placeholder="Buscar..." value="<?php echo esc_attr(get_search_query()); ?>">
                <button type="submit" aria-label="Buscar">⌕</button>
            </form></div>
    </div>
</header>
