<?php
/*
Template Name: Custom Logout
*/
ob_start();
get_header();
// Log the user out
wp_logout();

// Redirect to the homepage
wp_redirect(home_url());
exit;
?>

<h1>Logging Out</h1>
<p>You are being logged out. Redirecting...</p>

<?php get_footer(); ?>