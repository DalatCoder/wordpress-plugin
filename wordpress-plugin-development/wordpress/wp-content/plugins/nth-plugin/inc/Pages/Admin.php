<?php

/**
 * @package NTHPlugin
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\Api\SettingsApi;

class Admin extends BaseController
{
    public $settings;
    public function __construct()
    {
        $this->settings = new SettingsApi();
    }

    public function register()
    {
        $pages = [
            [
                'page_title' => 'NTN Plugin',
                'menu_title' => 'NTN Plugin',
                'capability' => 'manage_options',
                'menu_slug' => 'nth_plugin',
                'callback' => function () {
                    echo '';
                },
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];

        $this->settings->addPages($pages)->register();
    }
}
