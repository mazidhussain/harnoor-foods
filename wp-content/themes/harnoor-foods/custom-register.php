<?php
/*
Template Name: Custom Register
*/
ob_start();
get_header();
if (is_user_logged_in()) {
    // If user is already logged in, redirect them to another page
    wp_redirect(home_url()); // Redirect to the homepage
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_submit'])) {
    // Handle registration form submission
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];

    // Validate input
    // Create user
    $user_id = wp_create_user($username, $password, $email);

    if (!is_wp_error($user_id)) {
        // Log the user in
        wp_set_auth_cookie($user_id);
        wp_redirect(home_url()); // Redirect after successful registration
        exit;
    } else {
        $error_message = $user_id->get_error_message();
    }
}
?>
<div class="login-conatiner">
    <div class="login-register">
        <form method="post" action="">
            <h1>Register</h1>
            <?php if (isset($error_message)) : ?>
                 <div class="register-error"><?php echo esc_html($error_message); ?></div>
            <?php endif; ?>
            <div class="form-control">
                <input type="text" name="username" placeholder=" " required>
                <label>Username</label>
            </div>
            <div class="form-control">
                <input type="email" name="email" placeholder=" " required>
                <label>Email</label>
            </div>
            <div class="form-control">
                <input type="password" name="password" placeholder=" " required>
                <label>Password</label>
            </div>
            <input type="submit" class="btn btn--md" name="register_submit" value="Register">
        </form>
        <div class="not-account"> Don't you have an account? <a href="<?php echo site_url() . '/login' ?>">Login Now</a></div>
    </div>
</div>
