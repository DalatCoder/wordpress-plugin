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

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

define('PLUGIN_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_URL', plugin_dir_url(__FILE__));

if (class_exists('Inc\\Init')) {
    Inc\Init::register_services();
}
