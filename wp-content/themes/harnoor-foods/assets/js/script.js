jQuery(document).ready(function ($) {

    $('.wp-block-image img').each(function () {
        var imageSrc = $(this).attr('src');
        var caption = $(this).closest('.wp-block-image').find('.wp-element-caption').text();

        $(this).wrap('<a href="' + imageSrc + '" class="fancybox-trigger" data-fancybox="gallery" data-caption="' + caption + '"></a>');
    });

    $('.wp-block-code pre code').each(function () {
        var codeContent = $(this).text().trim();
        $(this).wrap('<div class="code-block"></div>');
        $(this).parent('.code-block').append('<button class="copy-button">Copy</button>');
    });


    $('.fancybox-trigger').fancybox({
        protect: false,
        buttons: [
            'zoom',
            'thumbs',
            'close'
        ],
        slideClass: 'watermark', // This adds a custom class for styling
        toolbar: false,
        smallBtn: true,
        touch: false,
        keyboard: true,
        arrows: false,
        preventCaptionOverlap: true,
        infobar: false,
        hideScrollbar: false
    });

    // Preload watermark image
    // Please, use your own image
    // console.log("Before preloading");
    // (new Image()).src = "<?php echo get_template_directory_uri(); ?>/assets/images/placeholder.jpg";
    // console.log("After preloading");

    $('.copy-button').click(function () {
        var codeBlock = $(this).closest('.code-head').next('pre').find('code');
        var codeText = codeBlock.text().trim();

        copyToClipboard(codeText, $(this));
    });

    function copyToClipboard(text, button) {
        var textarea = $('<textarea>').val(text);
        $('body').append(textarea);
        textarea.select();
        document.execCommand("copy");
        textarea.remove();

        button.find('span').text("Copied!");
        setTimeout(function () {
            button.find('span').text("Copy code");
        }, 2000);
    }

    $('.bookmark-button').on('click', function () {
        var postId = $(this).data('post-id');
        // Perform AJAX request to handle bookmark action
        $.post('ajax-url-to-handle-bookmark.php', { post_id: postId }, function (response) {
            if (response.success) {
                // Change button appearance or show a success message
                $(this).find('.cs-icon').removeClass('icon-bookmark-add').addClass('icon-bookmark-remove');
            }
        });
    });
});
