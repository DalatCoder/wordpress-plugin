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
    public $pages = array();
    public $subpages = array();

    public function __construct()
    {
        $this->settings = new SettingsApi();

        $this->pages = [
            [
                'page_title' => 'NTH Plugin',
                'menu_title' => 'NTH Plugin',
                'capability' => 'manage_options',
                'menu_slug' => 'nth_plugin',
                'callback' => function () {
                    echo 'NTH Plugin';
                },
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];

        $this->subpages = [
            [
                'parent_slug' => 'nth_plugin',
                'page_title' => 'Custom Post Types',
                'menu_title' => 'CPT',
                'capability' => 'manage_options',
                'menu_slug' => 'nth_cpt',
                'callback' => function () {
                    echo 'Custom Post Types Manager';
                },
            ],
            [
                'parent_slug' => 'nth_plugin',
                'page_title' => 'Custom Taxonomies',
                'menu_title' => 'Taxonomies',
                'capability' => 'manage_options',
                'menu_slug' => 'nth_taxonomies',
                'callback' => function () {
                    echo 'Taxonomies Manager';
                },
            ],
            [
                'parent_slug' => 'nth_plugin',
                'page_title' => 'Custom Widgets',
                'menu_title' => 'Widgets',
                'capability' => 'manage_options',
                'menu_slug' => 'nth_widgets',
                'callback' => function () {
                    echo 'Widgets Manager';
                },
            ],
        ];
    }

    public function register()
    {
        $this->settings
            ->addPages($this->pages)
            ->withSubPage('Dashboard')
            ->addSubpages($this->subpages)
            ->register();
    }
}
