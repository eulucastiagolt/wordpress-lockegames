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
        'category_name' => $category_name
    ] = $args + [
        'post-class' => 'col-12',
        'post-list-class' => '',
        'class'=>'',
        'columns' => 3,
        'columns_mobile' => 2,
        'category_name' => 'Noticias'
    ];

    $category = get_term_by('name', $category_name, 'category');
    $category_url = get_category_link($category->term_id);
?>
<section class="home-section <?php echo esc_attr($class); ?>">
    <div class="section-heading">
        <h2><?php echo esc_html($category->name ?? 'Publicações'); ?></h2>
        <a class="button" href="<?php echo esc_url($category_url ?: home_url('/')); ?>">Ver tudo</a>
    </div>
    <div class="posts-list<?php echo ' ' . $post_list_class; ?>">
            <?php
                while ($section_query->have_posts()):
                    $section_query->the_post();
                    $lockegames_used_ids[] = get_the_ID();
                    get_template_part( 'template-parts/content', 'card',
                        [
                            'excerpt' => false,
                            'class' => $post_class
                        ]
                    );
                endwhile;
            ?>
    </div>
</section>
<?php
    wp_reset_postdata();
?>
