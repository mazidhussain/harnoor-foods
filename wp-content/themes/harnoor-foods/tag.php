<?php
get_header();
$tag = single_tag_title('', false); // Get the current tag
$args = array(
    'post_type' => 'post', // Show only posts
    'posts_per_page' => $posts_per_page, // Number of posts per page
    'paged' => $paged,
    'tag' => $tag, // Filter by the current tag
);
$query = new WP_Query($args);
?>

<div class="container">
    <div class="home-main-section">
        <div class="all-posts-side">
            <h2 class="tag-title">Posts tagged with <span>"<?php echo $tag; ?>"</span></h2>
            <div class="main-posts">
                <?php

                if ($query->have_posts()) {
                ?>
                    <ul class="main-posts-list">
                        <?php
                        while ($query->have_posts()) {
                            $query->the_post();
                            // Display post content here
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
                                                    <?php
                                                    foreach ($tags as $tag) {
                                                    ?>
                                                        <span class="tag-item">
                                                            <a href=" <?php echo get_tag_link($tag->term_id); ?>">
                                                                <?php echo $tag->name; ?></a>
                                                        </span>
                                                    <?php  } ?>
                                                </div>
                                            <?php } ?>
                                            <p class="read-time">9 min read</p>
                                        </div>
                                        <a href="javascript:void(0)">
                                            <i class="cs-icon icon-bookmark-add"></i>
                                        </a>
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
                    echo paginate_links(array(
                        'total' => $query->max_num_pages,
                        'current' => $paged,
                    ));
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

        </div>
    </div>
</div>