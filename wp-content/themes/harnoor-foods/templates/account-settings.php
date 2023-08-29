<?php
if (is_user_logged_in()) {
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];

        if (wp_check_password($current_password, $current_user->user_pass, $current_user->ID)) {
            if ($new_password === $confirm_new_password) {
                wp_set_password($new_password, $current_user->ID);
                echo '<p class="success-message">Password changed successfully!</p>';
            } else {
                echo '<p class="error-message">New passwords do not match.</p>';
            }
        } else {
            echo '<p class="error-message">Incorrect current password.</p>';
        }
    }
}
?>
