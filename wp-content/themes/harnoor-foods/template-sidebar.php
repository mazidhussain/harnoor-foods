<?php
$args = array(
    'post_type' => 'post',
    'posts_per_page' => 10,
    'orderby' => 'meta_value_num', // Order by numerical value
    'meta_key' => 'post_views_count', // Use the view count custom field
    'order' => 'DESC', // Descending order
);
$query = new WP_Query($args);

if ($query->have_posts()) {
    while ($query->have_posts()) {
        $query->the_post();

        // Retrieve the post thumbnail URL
        $img = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // Use different image sizes: 'thumbnail', 'medium', 'large', 'full';
?>
        <div class="popular-posts">
            <ul class="popular-posts-list">
                <li>
                    <div class="img-side">
                        <img src="<?php echo $img; ?>" alt="">
                    </div>
                    <div class="text-side">
                        <h4><?php the_title(); ?></h4>
                        <p><?php the_date(); ?></p>
                    </div>
                </li>
            </ul>
        </div>
<?php
    }
    // Reset post data to restore the global post variables
    wp_reset_postdata();
} else {
    echo 'No posts found.';
}
?>
