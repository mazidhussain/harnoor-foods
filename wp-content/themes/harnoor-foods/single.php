<?php
get_header();
while (have_posts()) {
    the_post();
    $post_id = get_the_ID();
    $post_title = get_the_title($post_id);
    $post_content = get_the_content();
    $post_excerpt = get_the_excerpt();
    $post_tags = get_the_tags();
    $featured_image = get_the_post_thumbnail_url($post_id, 'full'); // You can use different image sizes: 'thumbnail', 'medium', 'large', 'full'
}
?>
<div class="single-feature-img">
    <img src="<?php echo $featured_image ?>" alt="">
</div>
<div class="single-page-container">
    <div class="post-desc">

        <h1>
            <?php echo $post_title ?>
        </h1>

        <div class="post-more-info">
            <?php
            if ($post_tags) {
            ?>
            <div class="post-list-tags">
                <?php
                    foreach ($post_tags as $tag) {
                    ?>
                <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag">
                    <?php echo $tag->name; ?>
                </a>
                <?php
                    }
                    ?>
            </div>
            <?php
            }
            ?>
        </div>

        <div class="main-content">
         <?php
                // Apply Fancybox to images with captions in the post content
                $content_with_fancybox = preg_replace_callback(
                    '/\[caption[^\]]*\](.*?)\[\/caption\]/i',
                    function($matches) {
                        $caption_content = $matches[1];
                        $caption_text = strip_tags($caption_content);

                        // Find the image source within the caption
                        $src_match = preg_match('/<img[^>]*src=[\'"]?([^\'" >]+)/i', $caption_content, $src_matches);
                        $image_src = '';
                        if ($src_match) {
                            $image_src = $src_matches[1];

                            // Construct the new image tag with Fancybox attributes
                            $new_img_tag = '<a href="' . $image_src . '" class="fancybox-trigger" data-fancybox="gallery" data-caption="' . esc_attr($caption_text) . '">' . $caption_content . '</a>';
                            return $new_img_tag;
                        }

                        return $caption_content;
                    },
                    $post_content
                );

                // Apply copy functionality to code blocks
                $content_with_copy = preg_replace_callback(
                    '/<pre[^>]*>.*?<code[^>]*>(.*?)<\/code>.*?<\/pre>/is',
                    function($matches) {
                        $code_content = $matches[1];

                        // Wrap code block with copy button
                        $code_block_with_copy = '<div class="code-block">' .
                                                '<div class="code-head">'.
                                                '<div class="code-title">Code</div>' .
                                                '<button class="copy-button"><svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg><span>Copy code</span></button>' .
                                                '</div>'.
                                                '<pre><code>' . $code_content . '</code></pre>' .
                                                '</div>';

                        return $code_block_with_copy;
                    },
                    $content_with_fancybox
                );

                echo $content_with_copy;
                ?>

                <?php comments_template(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
?>