
<?php

/*
Plugin Name: 12 Tab Instruction
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class NTHTabInstruction
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'generateMenu']);
        add_action('admin_enqueue_scripts', [$this, 'loadCSS']);
    }

    function loadCSS()
    {
        wp_register_style('tab_styles', plugins_url() . '/12.tab-instruction/style.css', false, '1.0.0');
        wp_enqueue_style('tab_styles');
    }

    function generateMenu()
    {
        add_menu_page(
            'Instructions',
            'Instructions',
            'manage_options',
            'nth-instructions',
            [$this, 'renderMenuPage'],
            'dashicons-shield',
            35
        );

        for ($page = 1; $page <= 4; $page++) {
            add_submenu_page(
                'nth-instructions',
                'Sub Page - ' . $page,
                'Sub Page - ' . $page,
                'manage_options',
                'admin.php?page=nth-instructions&tab=' . $page,
            );
        }
    }

    function renderMenuPage()
    {
        $show_tab_page1 = 'none';
        $show_tab_page2 = 'none';
        $show_tab_page3 = 'none';
        $show_tab_page4 = 'none';

        $tab_active_page1 = '';
        $tab_active_page2 = '';
        $tab_active_page3 = '';
        $tab_active_page4 = '';

        echo "HTML ";
    }
}

$instance = new NTHTabInstruction();
