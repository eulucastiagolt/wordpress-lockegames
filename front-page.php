<?php
get_header();
$lockegames_used_ids = array();
$hero_query = new WP_Query(array('post_type' => 'post', 'posts_per_page' => 4, 'ignore_sticky_posts' => true));
?>
<main id="main-content" class="site-main">
    <div class="container-xl mx-auto pt-4 pb-20">
        <section class="hero" aria-labelledby="hero-title">
            <?php if ($hero_query->have_posts()) : ?>
                <div class="hero-grid grid grid-cols-4 gap-4">
                    <?php
                        $index = 0;
                        while ($hero_query->have_posts()){
                            $hero_query->the_post();
                            $lockegames_used_ids[] = get_the_ID();

                            if ( $index === 0 ){
                                $post_container = " col-span-2 row-span-2 ";
                            } elseif ( $index === 1 ){
                                $post_container = " col-span-2 row-span-1 aspect-video";
                            }else{
                                $post_container = " col-span-1 row-span-1 aspect-square";
                            }

                            get_template_part('template-parts/content', 'hero', [
                                'post_container' => 'group/card-hero relative rounded-3xl overflow-hidden' . $post_container ,
                                'post_content' => 'absolute bottom-0 w-full h-full bg-linear-to-t from-black/90 to-black/0 flex flex-col justify-end p-6',
                                'post_image' => 'w-full h-full object-cover',
                                'post_image_container' => 'flex w-full h-full',
                                'post_title' => 'text-2xl font-bold text-white group-hover/card-hero:text-orange line-clamp-3',
                            ]);
                            
                            $index++;
                        };
                    ?>
                </div>
            <?php else : ?>
                <div class="empty-state">Ainda não há publicações. Adicione posts no painel do WordPress para preencher a revista.</div>
            <?php endif; wp_reset_postdata(); ?>
        </section>
    </div>

    <div class="container-xl py-20">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12 lg:col-span-7">
                <?php
                    get_template_part(
                        'template-parts/section', 'posts',
                        [
                            'title' => 'Notícias',
                            'class' => 'news-section',
                            'post-class' => '',
                            'post-list-class' => 'grid grid-cols-3 gap-3',
                            'query' => [
                                'posts_per_page' => 9
                            ]
                        ]
                    ); ?>
            </div>
            <div class="col-span-12 lg:col-span-5">
                <?php
                    get_template_part('template-parts/section', 'posts-horizontal', [
                        'title' => 'Lançamentos',
                        'class' => 'release-section compact-section',
                        'post-list-class' => 'flex flex-col gap-3',
                        'query' => [
                            'posts_per_page' => 5,
                            'category_name' => 'lancamento'
                        ]
                    ]);
                    ?>
            </div>
        </div>
    </div>

    <div class="bg-white py-20">
        <div class="container-xl mx-auto">
            <?php 
                get_template_part('template-parts/section', 'posts', 
                [
                    'title' => 'PC',
                    'class' => 'pc-section',
                    'post-class' => '',
                    'post-list-class' => 'grid grid-cols-4 gap-3',
                    'query' => [
                        'posts_per_page' => 8,
                        'category_name' => 'pc'
                    ]
                ]);
            ?>
        </div>
    <div>
        
    <section class="platform-sections container-xl">
        <div class="platform-grid grid grid-cols-1 gap-6 lg:grid-cols-3">
            <?php get_template_part('template-parts/section', 'posts-horizontal', array('title' => 'Xbox', 'class' => 'platform-section xbox-section', 'post-list-class' => 'flex flex-col gap-3', 'query' => array('posts_per_page' => 4, 'category_name' => 'xbox'))); ?>
            <?php get_template_part('template-parts/section', 'posts-horizontal', array('title' => 'PlayStation', 'class' => 'platform-section playstation-section', 'post-list-class' => 'flex flex-col gap-3', 'query' => array('posts_per_page' => 4, 'category_name' => 'playstation'))); ?>
            <?php get_template_part('template-parts/section', 'posts-horizontal', array('title' => 'Nintendo', 'class' => 'platform-section nintendo-section', 'post-list-class' => 'flex flex-col gap-3', 'query' => array('posts_per_page' => 4, 'category_name' => 'nintendo'))); ?>
        </div>
    </section>

    <section class="container-xl">
        <?php get_template_part('template-parts/section', 'posts', array('title' => 'eSports', 'class' => 'esports-section', 'query' => array('posts_per_page' => 3, 'category_name' => 'esports'))); ?>
        <?php get_template_part('template-parts/section', 'posts', array('title' => 'Reviews', 'class' => 'reviews-section', 'query' => array('posts_per_page' => 4, 'category_name' => 'reviews'))); ?>
        <?php get_template_part('template-parts/section', 'posts-horizontal', [
                'title' => 'Eventos',
                'class' => 'events-section',
                'post-list-class' => 'grid grid-cols-1 md:grid-cols-2 gap-4',
                'query' => array('posts_per_page' => 4, 'category_name' => 'eventos')
            ]); 
        ?>
    </section>
</main>
<?php get_footer(); ?>
