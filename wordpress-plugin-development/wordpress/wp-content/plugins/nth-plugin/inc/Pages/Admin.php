<?php

/**
 * @package NTHPlugin
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController
{
    public $settings;
    public $callbacks;

    public $pages = array();
    public $subpages = array();

    public function __construct()
    {
        parent::__construct();
    }

    public function register()
    {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->setPages();

        $this->setSubpages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings
            ->addPages($this->pages)
            ->withSubPage('Dashboard')
            ->addSubpages($this->subpages)
            ->register();
    }

    public function setPages()
    {
        $this->pages = [
            [
                'page_title' => 'NTH Plugin',
                'menu_title' => 'NTH Plugin',
                'capability' => 'manage_options',
                'menu_slug' => 'nth_plugin',
                'callback' => array($this->callbacks, 'adminDashboard'),
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];
    }

    public function setSubpages()
    {
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

    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'nth_options_group',
                'option_name' => 'text_example',
                'callback' =>   [$this->callbacks, 'nthOptionsGroup']
            ]
        ];

        $this->settings->setSettings($args);
    }

    public function setSections()
    {
        $args = [
            [
                'id' => 'nth_admin_index',
                'title' => 'Settings',
                'callback' =>   [$this->callbacks, 'nthAdminSection'],
                'page' => 'nth_plugin'
            ]
        ];

        $this->settings->setSections($args);
    }

    public function setFields()
    {
        $args = [
            [
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' =>   [$this->callbacks, 'nthAdminTextExample'],
                'page' => 'nth_plugin',
                'section' => 'nth_admin_index',
                'args' => [
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                ]
            ]
        ];

        $this->settings->setFields($args);
    }
}
