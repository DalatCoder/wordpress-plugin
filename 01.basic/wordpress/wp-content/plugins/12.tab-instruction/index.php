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
        // Hide all sections by default
        $show_tab_page1 = 'none';
        $show_tab_page2 = 'none';
        $show_tab_page3 = 'none';
        $show_tab_page4 = 'none';

        // Set the active tab
        $tab_active_page1 = '';
        $tab_active_page2 = '';
        $tab_active_page3 = '';
        $tab_active_page4 = '';

        if ($_GET['tab']) {
            switch ($_GET['tab']) {
                case '2':
                    $show_tab_page2 = 'block';
                    $tab_active_page2 = 'tab-active';
                    break;
                case '3':
                    $show_tab_page3 = 'block';
                    $tab_active_page3 = 'tab-active';
                    break;
                case '4':
                    $show_tab_page4 = 'block';
                    $tab_active_page4 = 'tab-active';
                    break;
                default:
                    $show_tab_page1 = 'block';
                    $tab_active_page1 = 'tab-active';
                    break;
            }
        } else {
            // Tab 1 is set by default
            $show_tab_page1 = 'block';
            $tab_active_page1 = 'tab-active';
        }

        echo '
            <h2 class="nav-tab-wrapper">
                <a href="' . $this->generateTablink(1) . '" id="tab-page1" class="' . $tab_active_page1 . ' sec-file-tab nav-tab">Blogs</a>
                <a href="' . $this->generateTablink(2) . '" id="tab-page2" class="' . $tab_active_page2 . ' sec-file-tab nav-tab">Tab 2</a>
                <a href="' . $this->generateTablink(3) . '" id="tab-page3" class="' . $tab_active_page3 . ' sec-file-tab nav-tab">Tab 3</a>
                <a href="' . $this->generateTablink(4) . '" id="tab-page4" class="' . $tab_active_page4 . ' sec-file-tab nav-tab">Tab 4</a>
            </h2>
        ';

        if ($show_tab_page1 === 'block') {
            echo "
                <div class='tab-section' style='display: $show_tab_page1' id='page1'>
                    <h2>All posts</h2>
                </div>
            ";

            $query = new WP_Query([
                'post_type' => 'post',
            ]);

            if ($query->have_posts()) {
                echo '<ul>';
                while ($query->have_posts()) {
                    $query->the_post();
                    $plink = get_permalink();
                    echo '<li><a target="_blank" href="' . $plink . '">' . get_the_title() . '</a>' . '</li>';
                }
                echo '</ul>';

                wp_reset_postdata();
            } else {
                echo '<p>No posts found.</p>';
            }
        }

        echo "
            <div class='tab-section' style='display: $show_tab_page2' id='page1'>
                <h2>Page 2</h2>
                <p>Content pending</p>
            </div>
        ";
        echo "
            <div class='tab-section' style='display: $show_tab_page3' id='page1'>
                <h2>Page 3</h2>
                <p>Content pending</p>
            </div>
        ";
        echo "
            <div class='tab-section' style='display: $show_tab_page4' id='page1'>
                <h2>Page 4</h2>
                <p>Content pending</p>
            </div>
        ";
    }

    function generateTablink($tabId)
    {
        return  get_admin_url() . 'admin.php?page=nth-instructions&tab=' . $tabId;
    }
}

$instance = new NTHTabInstruction();
