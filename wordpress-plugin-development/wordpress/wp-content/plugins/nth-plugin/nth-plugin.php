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
    function __construct()
    {
        add_action('init', array($this, 'custom_post_type'));
    }

    function activate()
    {
        // Generated a custom post type
        $this->custom_post_type();

        // Flush rewrite rules
        flush_rewrite_rules();
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

    function custom_post_type()
    {
        register_post_type('book', [
            'public' => true,
            'label' => 'Books'
        ]);
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
