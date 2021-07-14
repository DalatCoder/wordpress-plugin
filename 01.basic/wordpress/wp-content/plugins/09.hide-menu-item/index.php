<?php

/*
Plugin Name: 09 Hide Menu Item
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class NTHHideMenuItem
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'hideMenus']);
    }

    function hideMenus()
    {
        $currentUser = wp_get_current_user();
        $username = $currentUser->user_login;

        // Remove those things
        $plugin_pages_to_remove = [
            'activity_log_page',
            'wpcf-ctt',
            'wpcf7',
            'dulicator',
            'swiftype'
        ];

        $admin_pages_to_remove = [
            'index.php',
            'edit-comments.php',
            'plugins.php',
            'themes.php'
        ];

        $user_pages_to_remove = [
            'users.php'
        ];

        $user_link_pages_to_remove = [
            'edit.php?post_type=useful-link'
        ];

        $hr_pages_to_remove = [
            'edit.php?post_type=job_listing'
        ];

        $editor_pages_to_remove = [
            'edit.php',
            'edit.php?post_type=page',
            'upload.php'
        ];

        // Display certain pages for certain users
        $plugin_admin_pages = ['admin2'];
        $display_admin_pages = ['admin2'];
        $display_user_link_page = ['admin2'];
        $display_hr_page = ['admin2'];
        $display_users_page = ['admin2'];
        $display_editor_page = ['admin2'];

        if (!in_array($username, $plugin_admin_pages)) {
            foreach ($plugin_pages_to_remove as $page) {
                remove_menu_page($page);
            }
        }

        if (!in_array($username, $display_user_link_page)) {
            foreach ($user_link_pages_to_remove as $page) {
                remove_menu_page($page);
            }
        }

        // Test emoji
    }
}
