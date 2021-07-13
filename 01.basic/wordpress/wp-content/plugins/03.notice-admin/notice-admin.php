<?php

/**
 * Plugin Name: Notice Admin
 * Description: Notice Admin
 * Version: 1.0
 * Author: 2nth
 */

class NoticeAdmin
{
    function __construct()
    {
        add_action('admin_notices', [$this, 'showNotice']);

        add_action('wp_login', [$this, 'createUserLogEntry'], 10, 2);
    }

    function showNotice()
    {
        $user = wp_get_current_user();
        echo 'Hello ' . $user->display_name . '<br>';
    }

    function createUserLogEntry($user_login_name, $userObject)
    {
        $args = [
            'post_type' => 'post',
            'post_title' => 'Login by ' . $user_login_name . ' at ' . date("H:i:s m/d/Y"),
            'post_status' => 'private',
            # 'post_category' => []
            # 'post_author' => $userObject->ID
        ];

        $postId = wp_insert_post($args);

        # LogUtils::writeLog('Create log with post ID: ' . $postId);
    }
}

$noticeAdmin = new NoticeAdmin();
