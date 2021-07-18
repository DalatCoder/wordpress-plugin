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

if (class_exists('NTHPlugin')) {
    error_log('Class NTHPlugin have already defined');
    exit;
}

class NTHPlugin
{
    function __construct()
    {
        add_action('init', array($this, 'custom_post_type'));
    }

    function register_admin_scripts()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function register_client_scripts()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));
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

    function custom_post_type()
    {
        register_post_type('book', [
            'public' => true,
            'label' => 'Books'
        ]);
    }

    function enqueue()
    {
        // enqueue all our scripts
        wp_enqueue_style('mypluginstyle', plugins_url('/assets/style.css', __FILE__), [], bin2hex(random_bytes(10)));
        wp_enqueue_script('mypluginscript', plugins_url('/assets/script.js', __FILE__), [], bin2hex(random_bytes(10)), true);
    }
}

$instance = new NTHPlugin();
$instance->register_admin_scripts();

// activate | the same as add_action('<action>', 'function');
register_activation_hook(__FILE__, array($instance, 'activate'));

// deactivate
register_deactivation_hook(__FILE__, array($instance, 'deactivate'));
