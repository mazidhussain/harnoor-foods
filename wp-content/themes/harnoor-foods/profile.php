<?php
/*
Template Name: Profile Page
*/

get_header();

// Get the current user
$current_user = wp_get_current_user();

if (is_user_logged_in()) {
    // Handle password change form submission
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_new_password = $_POST['confirm_new_password'];

        // Verify current password
        if (wp_check_password($current_password, $current_user->user_pass, $current_user->ID)) {
            // Change the password
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

    // Handle username change form submission
    if (isset($_POST['change_nicename'])) {
        $new_nicename = sanitize_user($_POST['new_nicename']);

        // Check if the new nicename already exists
        if (username_exists($new_nicename)) {
            echo '<p class="error-message">Username already exists. Please choose a different username.</p>';
        } else {
            $user_data = array(
                'ID' => $current_user->ID,
                'user_nicename' => $new_nicename,
            );

            $user_id = wp_update_user($user_data);

            if (!is_wp_error($user_id)) {
                // Refresh the user object
                $current_user = wp_get_current_user();
                echo '<p class="success-message">Username changed successfully!</p>';
            } else {
                echo '<p class="error-message">Error updating username. Please try again.</p>';
            }
        }
    }

    if (isset($_POST['upload_profile_picture'])) {
        $profile_picture = $_FILES['profile_picture'];

        // Check if a file was uploaded
        if ($profile_picture['error'] === 0) {
            // Upload the file and update the user's avatar
            $upload_dir = wp_upload_dir();
            $file_name = sanitize_file_name($profile_picture['name']);
            $file_path = $upload_dir['path'] . '/' . $file_name;

            if (move_uploaded_file($profile_picture['tmp_name'], $file_path)) {
                $attachment_id = media_handle_upload($file_name, 0);
                if (!is_wp_error($attachment_id)) {
                    // Update the user's avatar
                    update_user_meta($current_user->ID, 'wp_user_avatar', $attachment_id);
                    echo '<p class="success-message">Profile picture updated successfully!</p>';
                } else {
                    echo '<p class="error-message">Error uploading profile picture. Please try again.</p>';
                }
            } else {
                echo '<p class="error-message">Error uploading profile picture. Please try again.</p>';
            }
        }
    }
}
?>

<div class="profile-container">
    <h2><?php echo esc_html($current_user->display_name); ?>'s Profile</h2>

    <!-- Display User Profile Image -->
    <div class="profile-image">
        <?php echo get_avatar($current_user->ID, 150); ?>
    </div>
     <div class="upload-profile-picture-form">
        <h3>Upload Profile Picture</h3>
        <form method="post" enctype="multipart/form-data">
            <label for="profile_picture">Select an image:</label>
            <input type="file" name="profile_picture" accept="image/*" required><br>
            <input type="submit" name="upload_profile_picture" value="Upload Profile Picture">
        </form>
    </div>


    <!-- Display Username -->
    <p><strong>Username:</strong> <?php echo esc_html($current_user->user_login); ?></p>

    <!-- Edit Username Form -->
    <!-- Edit Nicename Form -->
    <div class="edit-nicename-form">
        <h3>Edit Nicename</h3>
        <form method="post">
            <label for="new_nicename">New Nicename:</label>
            <input type="text" name="new_nicename" value="<?php echo esc_attr($current_user->user_nicename); ?>" required><br>
            <input type="submit" name="change_nicename" value="Change Nicename">
        </form>
    </div>

    <!-- Change Password Form -->
    <div class="change-password-form">
        <h3>Change Password</h3>
        <form method="post">
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" required><br>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required><br>
            <label for="confirm_new_password">Confirm New Password:</label>
            <input type="password" name="confirm_new_password" required><br>
            <input type="submit" name="change_password" value="Change Password">
        </form>
    </div>
</div>

<?php
get_footer();
?>
