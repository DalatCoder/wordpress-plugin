<?php

/**
 * Plugin Name: Debug WordPress to Log File
 * Description: Debug WordPress to Log File
 * Version: 1.0
 * Author: 2nth
 */

define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);

ini_set('error_log', WP_CONTENT_DIR . '/debug.log');

function log_me($message)
{
    if (WP_DEBUG === true) {
        if (is_array($message) || is_object($message)) {
            error_log(print_r($message, true));
        } else {
            error_log($message);
        }
    }
}
