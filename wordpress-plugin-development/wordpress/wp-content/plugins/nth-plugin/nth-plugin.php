<?php

/**
 * @package NTHPlugin
 */

/**
 * Plugin Name: NTH Plugin 
 * Plugin URI: http://nth.com
 * Description: This is my first attempt on writting a custom Plugin. <strong>Trong Hieu</strong>
 * Version: 1.0.0
 * Author: Nguyen Trong Hieu
 * Author URI: http://nth.com
 * License: GPLv2 or later
 * Text Domain: nth-plugin
 */


defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

class NTHPlugin
{

    function activate()
    {
        // Generated a custom post type
        // Flush rewrite rules
    }

    function deactivate()
    {
        // Flush rewrite rules
    }

    function uninstall()
    {
        // Delete custom post type
        // Delete all the plugin data from DB
    }
}

if (class_exists('NTHPlugin')) {
    $instance = new NTHPlugin();
}

// activate | the same as add_action('<action>', 'function');
register_activation_hook(__FILE__, array($instance, 'activate'));

// deactivate
register_deactivation_hook(__FILE__, array($instance, 'deactivate'));

// uninstall
