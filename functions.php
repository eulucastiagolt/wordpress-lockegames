<?php
if (!defined('ABSPATH')) { exit; }

function lockegames_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    register_nav_menus(array(
        'primary' => __('Menu principal', 'lockegames'),
        'footer' => __('Menu do rodapé', 'lockegames'),
    ));
}
add_action('after_setup_theme', 'lockegames_setup');

function lockegames_widgets_init() {
    register_sidebar(array(
        'name' => __('Sidebar do artigo', 'lockegames'),
        'id' => 'post-sidebar',
        'description' => __('Widgets exibidos apenas na página de leitura do post.', 'lockegames'),
        'before_widget' => '<section id="%1$s" class="widget post-sidebar-widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'lockegames_widgets_init');

function lockegames_relative_post_date($post = null) {
    $post_time = get_post_time('U', true, $post);
    $now = current_time('timestamp', true);
    $diff = max(0, $now - $post_time);

    if ($diff < MINUTE_IN_SECONDS) {
        $value = max(1, $diff);
        return sprintf('Há %d %s', $value, 1 === $value ? 'segundo' : 'segundos');
    }

    if ($diff < HOUR_IN_SECONDS) {
        $value = floor($diff / MINUTE_IN_SECONDS);
        return sprintf('Há %d %s', $value, 1 === $value ? 'minuto' : 'minutos');
    }

    if ($diff < DAY_IN_SECONDS) {
        $value = floor($diff / HOUR_IN_SECONDS);
        return sprintf('Há %d %s', $value, 1 === $value ? 'hora' : 'horas');
    }

    $days = floor($diff / DAY_IN_SECONDS);
    if ($days < 30) {
        return sprintf('Há %d %s', $days, 1 === $days ? 'dia' : 'dias');
    }

    if ($days < 365) {
        $value = max(1, floor($days / 30));
        return sprintf('Há %d %s', $value, 1 === $value ? 'mês' : 'meses');
    }

    return get_the_date('d/m/Y', $post);
}

function lockegames_assets() {
    wp_enqueue_style('lockegames-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap', array(), null);
    $fontawesome = get_template_directory() . '/assets/vendor/fontawesome/css/all.min.css';
    $fontawesome_version = file_exists($fontawesome) ? filemtime($fontawesome) : '1.0.0';
    wp_enqueue_style('lockegames-fontawesome', get_template_directory_uri() . '/assets/vendor/fontawesome/css/all.min.css', array(), $fontawesome_version);
    $tailwind = get_template_directory() . '/assets/css/tailwind.css';
    $tailwind_version = file_exists($tailwind) ? filemtime($tailwind) : '1.0.0';
    wp_enqueue_style('lockegames-tailwind', get_template_directory_uri() . '/assets/css/tailwind.css', array(), $tailwind_version);
    $stylesheet = get_stylesheet_directory() . '/style.css';
    $version = file_exists($stylesheet) ? filemtime($stylesheet) : '1.0.0';
    wp_enqueue_style('lockegames-style', get_stylesheet_uri(), array('lockegames-fonts', 'lockegames-fontawesome', 'lockegames-tailwind'), $version);
    wp_enqueue_script('lockegames-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), '1.0.1', true);
}
add_action('wp_enqueue_scripts', 'lockegames_assets');
