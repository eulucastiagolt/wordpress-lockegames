<?php
if (!defined('ABSPATH')) {
    exit;
}

if (post_password_required()) {
    return;
}
?>

<section id="comments" class="comments-area" aria-labelledby="comments-title">
    <?php if (have_comments()) : ?>
        <h2 id="comments-title" class="comments-title">
            <?php
            $comments_number = get_comments_number();
            printf(
                esc_html(_n('%s comentário', '%s comentários', $comments_number, 'lockegames')),
                esc_html(number_format_i18n($comments_number))
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'avatar_size' => 48,
                'style' => 'ol',
                'short_ping' => true,
            ));
            ?>
        </ol>

        <?php
        the_comments_pagination(array(
            'prev_text' => '<i class="fa-solid fa-arrow-left"></i>',
            'next_text' => '<i class="fa-solid fa-arrow-right"></i>',
        ));
        ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number()) : ?>
        <p class="no-comments"><?php esc_html_e('Os comentários estão fechados.', 'lockegames'); ?></p>
    <?php endif; ?>

    <?php
    comment_form(array(
        'class_container' => 'comment-respond',
        'class_form' => 'comment-form',
        'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
        'title_reply_after' => '</h2>',
        'label_submit' => esc_html__('Enviar comentário', 'lockegames'),
    ));
    ?>
</section>
