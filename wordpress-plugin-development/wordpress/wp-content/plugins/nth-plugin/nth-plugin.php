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


// If this file is called directly, abort!!!
defined('ABSPATH') or die('Hey, what are you doing here? You silly human!');

// Require once the Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

// The code that runs during plugin activation
function activate_nth_plugin()
{
    flush_rewrite_rules();
}

// The code that runs during plugin deactivation
function deactivate_nth_plugin()
{
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'activate_nth_plugin');
register_deactivation_hook(__FILE__, 'deactivate_nth_plugin');

if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}
