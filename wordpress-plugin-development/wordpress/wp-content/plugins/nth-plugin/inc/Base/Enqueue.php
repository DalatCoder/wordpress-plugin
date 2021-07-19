<?php

/**
 * @package NTHPlugin
 */

namespace Inc\Base;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }

    function enqueue()
    {
        wp_enqueue_style('mypluginstyle', $this->plugin_url . 'assets/style.css', [], bin2hex(random_bytes(10)));
        wp_enqueue_script('mypluginscript', $this->plugin_url . 'assets/script.js', [], bin2hex(random_bytes(10)), true);
    }
}
