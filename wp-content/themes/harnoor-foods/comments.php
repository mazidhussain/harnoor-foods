<div id="comments" class="comments-area comment-ui">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $comments_number = get_comments_number();
            if ('1' === $comments_number) {
                printf(_x('1 comment', 'comments title', 'Codifyinfo'));
            } else {
                printf(
                    _nx(
                        '%1$s comments',
                        '%1$s comments',
                        $comments_number,
                        'comments title',
                        'codifyinfo'
                    ),
                    number_format_i18n($comments_number)
                );
            }
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments(
                array(
                    'style' => 'ol',
                    'short_ping' => true,
                    'avatar_size' => 55,
                )
            );
            ?>
        </ol>

        <?php
        the_comments_pagination(
            array(
                'prev_text' => '<span class="screen-reader-text">' . __('Previous', 'codifyinfo') . '</span>',
                'next_text' => '<span class="screen-reader-text">' . __('Next', 'codifyinfo') . '</span>',
            )
        );
        ?>

    <?php endif; // Check for have_comments().

    comment_form(
        array(
            'class_form' => 'comment-form',
            'title_reply' => __('Leave a Comment', 'codifyinfo'),
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'label_submit' => __('Post Comment', 'codifyinfo'),
            'class_submit' => 'submit-button',
        )
    );
    ?>

</div><!-- #comments -->
