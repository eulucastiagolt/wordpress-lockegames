<?php
if (!defined('ABSPATH')) { exit; }

function lockegames_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    register_nav_menus(array('primary' => __('Navegação principal', 'lockegames')));
}
add_action('after_setup_theme', 'lockegames_setup');

function lockegames_assets() {
    wp_enqueue_style('lockegames-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap', array(), null);
    $stylesheet = get_stylesheet_directory() . '/style.css';
    $version = file_exists($stylesheet) ? filemtime($stylesheet) : '1.0.0';
    wp_enqueue_style('lockegames-style', get_stylesheet_uri(), array('lockegames-fonts'), $version);
    wp_enqueue_script('lockegames-menu', get_template_directory_uri() . '/assets/js/menu.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'lockegames_assets');

function lockegames_menu_fallback() {
    echo '<ul id="primary-menu" class="main-nav">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Início</a></li>';
    echo '<li><a href="' . esc_url(get_post_type_archive_link('post')) . '">Notícias</a></li>';
    echo '<li><a href="' . esc_url(home_url('/?s=análise')) . '">Análises</a></li>';
    echo '<li><a href="' . esc_url(home_url('/?s=e-sports')) . '">E-sports</a></li>';
    echo '<li><a href="' . esc_url(home_url('/?s=grátis')) . '">Jogos grátis</a></li></ul>';
}

function lockegames_image($index = 0, $size = 'large') {
    $images = array(
        'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&w=1200&q=85',
        'https://images.unsplash.com/photo-1511512578047-dfb367046420?auto=format&fit=crop&w=900&q=85',
        'https://images.unsplash.com/photo-1550745165-9bc0b252726f?auto=format&fit=crop&w=900&q=85',
        'https://images.unsplash.com/photo-1593305841991-05c297ba4575?auto=format&fit=crop&w=900&q=85',
        'https://images.unsplash.com/photo-1560419015-7c427e8ae5ba?auto=format&fit=crop&w=900&q=85',
        'https://images.unsplash.com/photo-1603481546238-487240415921?auto=format&fit=crop&w=900&q=85'
    );
    if (has_post_thumbnail()) { return get_the_post_thumbnail_url(get_the_ID(), $size); }
    return $images[$index % count($images)];
}

function lockegames_demo_posts() {
    return array(
        array('title' => 'O próximo grande jogo de aventura já tem data para chegar', 'category' => 'Notícias', 'date' => 'há 2 horas', 'image' => 0, 'url' => '#'),
        array('title' => 'Sete detalhes que você pode ter perdido no novo trailer', 'category' => 'Notícias', 'date' => 'há 5 horas', 'image' => 1, 'url' => '#'),
        array('title' => 'Este clássico dos games acaba de ganhar uma nova vida', 'category' => 'Cultura', 'date' => 'há 1 dia', 'image' => 2, 'url' => '#'),
        array('title' => 'Analisamos a experiência mais criativa do ano', 'category' => 'Análises', 'date' => 'há 1 dia', 'image' => 3, 'url' => '#'),
        array('title' => 'Tudo sobre a nova temporada competitiva', 'category' => 'E-sports', 'date' => 'há 2 dias', 'image' => 4, 'url' => '#'),
        array('title' => 'Cinco jogos gratuitos para instalar neste fim de semana', 'category' => 'Jogos grátis', 'date' => 'há 3 dias', 'image' => 5, 'url' => '#')
    );
}
