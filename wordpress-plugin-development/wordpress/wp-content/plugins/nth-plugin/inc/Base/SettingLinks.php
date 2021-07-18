<?php

/**
 * @package NTHPlugin
 */

namespace Inc\Base;

class SettingLinks
{
    protected $plugin;

    public function __construct()
    {
        $this->plugin = PLUGIN;
    }

    public function register()
    {
        add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
    }

    function settings_link($links)
    {
        $settings_link = '<a href="admin.php?page=nth_plugin">Settings</a>';
        array_push($links, $settings_link);
        return $links;
    }
}
