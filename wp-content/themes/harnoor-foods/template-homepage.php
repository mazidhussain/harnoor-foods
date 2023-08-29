<?php
/* 
Template Name: Homepage
*/
get_header();
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$posts_per_page = get_option('posts_per_page');
$userId = get_current_user_id();
?>
<main>
    <div class="container">
        <div class="home-main-section">
            <div class="all-posts-side">
                <div class="categories-nav">
                    <ul class="categories-nav__list">
                        <li class="categories-nav__item active">
                            <a class="categories-nav__link" href="<?php echo esc_url(home_url('/')); ?>">All</a>
                        </li>
                        <?php
                        $categories = get_terms(
                            array(
                                'taxonomy' => 'category',
                                // Taxonomy name
                                'hide_empty' => false,
                                // Show empty categories
                            )
                        );
                        foreach ($categories as $category) {
                            echo '<li class="categories-nav__item"><a class="categories-nav__link" href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="main-posts">
                    <?php
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => $posts_per_page,
                        'paged' => $paged,
                    );
                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        ?>
                        <ul class="main-posts-list">
                            <?php
                            while ($query->have_posts()) {
                                $query->the_post();
                                // Display post content here
                                $comment_count = get_comments_number($post->ID);
                                $isPostBookmarked = $wpdb->get_var("SELECT id from `bookmarked_post` WHERE `user_id`={$userId} AND `post_id`={$post->ID} ");
                                ?>
                                <li class="post">

                                    <div class="text-side">
                                        <h3 class="post-list-title">
                                            <a href="<?php echo get_permalink(); ?>">
                                                <?php echo get_the_title(); ?>
                                            </a>
                                        </h3>
                                        <p class="post-list-desc">
                                            <?php echo get_the_excerpt(); ?>
                                        </p>
                                        <div class="post-list-item-footer">
                                            <div class="post-item-footer-left">
                                                <?php
                                                $tags = get_the_tags();
                                                if ($tags) {
                                                    ?>
                                                    <div class="post-list-tags">
                                                        <?php foreach ($tags as $tag) { ?>
                                                            <span class="tag-item">
                                                                <a href=" <?php echo get_tag_link($tag->term_id); ?>">
                                                                    <?php echo $tag->name; ?></a>
                                                            </span>
                                                        <?php } ?>
                                                    </div>
                                                <?php } ?>
                                                <p class="read-time">9 min read</p>
                                                <?php if ($comment_count > 0) { ?>
                                                    <p class="read-time total-comment">
                                                        <?php echo $comment_count . ' ' . _n('Comment', 'Comments', $comment_count); ?>
                                                    </p>
                                                <?php } ?>
                                            </div>
                                            <div class="action-item">
                                                <?php if (is_user_logged_in()) { ?>
                                                    <a href="javascript:void(0)">
                                                        <i id="post-<?php echo $post->ID; ?>" data-attr="<?php echo $post->ID ?>"
                                                            class="cs-icon <?php echo empty($isPostBookmarked) ? 'icon-bookmark-add bookmark' : 'icon-bookmark remove-bookmark' ?>"></i>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="post-list-img">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                the_post_thumbnail('medium'); // You can use different image sizes: 'thumbnail', 'medium', 'large', 'full'
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <?php
                                    ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                        echo '<div class="pagination">';
                        echo paginate_links(
                            array(
                                'total' => $query->max_num_pages,
                                'current' => $paged,
                            )
                        );
                        echo '</div>';
                        wp_reset_postdata();
                    } // Reset the query
                    else {
                        echo 'No posts found.';
                    }
                    ?>
                </div>
            </div>
            <div class="sidebar">
                <?php
                get_template_part('template-sidebar');
                ?>
            </div>
        </div>
    </div>
</main>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script>
    $('.bookmark').click(function (e) {
        let postId = $(this).attr('data-attr');
        $.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            data: { action: 'bookmark', post_id: postId },
            success: function (res) {
                res = JSON.parse(res);
                if (res.status == '1') {
                    $(`#post-${postId}`).removeClass("icon-bookmark-add");
                    $(`#post-${postId}`).removeClass("bookmark ");
                    $(`#post-${postId}`).addClass("icon-bookmark");
                    $(`#post-${postId}`).addClass("remove-bookmark");
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
    $('.remove-bookmark').click(function () {
        let postId = $(this).attr('data-attr');
        $.ajax({
            type: "POST",
            url: '<?php echo admin_url('admin-ajax.php') ?>',
            data: { action: 'remove_bookmark', post_id: postId },
            success: function (res) {
                res = JSON.parse(res);
                if (res.status == '1') {
                    $(`#post-${postId}`).addClass("icon-bookmark-add");
                    $(`#post-${postId}`).addClass("bookmark ");
                    $(`#post-${postId}`).removeClass("icon-bookmark");
                    $(`#post-${postId}`).removeClass("remove-bookmark");
                }
            },
            error: function (err) {
                console.log(err);
            }
        });
    });
</script>