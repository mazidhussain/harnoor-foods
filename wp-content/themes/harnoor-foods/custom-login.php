<?php
/* 
Template Name: Login
*/
ob_start();
get_header();
if (is_user_logged_in()) {
    // If user is already logged in, redirect them to another page
    wp_redirect(home_url()); // Redirect to the homepage
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $username = sanitize_user($_POST['username']);
    $password = $_POST['password'];

    $user = wp_authenticate($username, $password);

    if (is_wp_error($user)) {
        $error_message = 'Invalid username or password';
    } else {
        wp_set_auth_cookie($user->ID);
        wp_redirect(home_url()); // Redirect after successful login
        exit;
    }
}
?>
<div class="login-conatiner">
    <div class="login-register">
        <form method="post" action="">
            <h1>Welcome Back !</h1>
            <?php if (isset($error_message)) : ?>
                <div class="login-error"><?php echo esc_html($error_message); ?></div>
            <?php endif; ?>
            <div class="form-control">
                <input type="text" name="username" placeholder=" " required>
                <label>Username or Email</label>
            </div>
            <div class="form-control">
                <input type="password" name="password" placeholder=" " required>
                <label>Password</label>
            </div>
            <input type="submit" class="btn btn--md" name="login_submit" value="Login">
        </form>
        <div class="not-account"> Don't you have an account? <a href="<?php echo site_url() . '/registration' ?>">Register Now</a></div>
    </div>
</div>
<?php get_footer();
?>