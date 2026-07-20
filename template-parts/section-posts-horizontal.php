<?php
    global $lockegames_used_ids;
    $query_args = wp_parse_args($args['query'] ?? array(), array('post_type' => 'post', 'posts_per_page' => 4, 'ignore_sticky_posts' => true));
    $query_args['post__not_in'] = $lockegames_used_ids;
    $section_query = new WP_Query($query_args);
    if (!$section_query->have_posts()) {
        wp_reset_postdata();
        return;
    }
    [
        'post-class' => $post_class,
        'post-list-class' => $post_list_class,
        'columns' => $columns,
        'columns_mobile' => $columns_mobile,
        'class' => $class,
    ] = $args + [
        'post-class' => 'col-12',
        'post-list-class' => '',
        'class'=>'',
        'columns' => 3,
        'columns_mobile' => 2
    ];
?>
<section class="home-section <?php echo esc_attr($args['class'] ?? ''); ?>">
    <div class="section-heading"><h2><?php echo esc_html($args['title'] ?? 'Publicações'); ?></h2><a class="button" href="<?php echo esc_url(get_post_type_archive_link('post') ?: home_url('/')); ?>">Ver tudo</a></div>
    <div class="posts-list <?php echo $post_list_class; ?>">
        <?php
            while ($section_query->have_posts()) :$section_query->the_post(); 
                $lockegames_used_ids[] = get_the_ID();
                get_template_part('template-parts/content', 'card-horizontal', array('excerpt' => false, 'class' => 'col-12'));
            endwhile;
        ?>
    </div>
</section>
<?php
    wp_reset_postdata();
?>
