<?php

/*
Plugin Name: 05 Create Custom Dashboard Widget
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class MyOwnCustomDashboardWidget
{
    function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'addCustomWidget']);
    }

    function addCustomWidget()
    {
        wp_add_dashboard_widget('custom_help_widget', 'Good Morning', [$this, 'generateHTML']);
    }

    function generateHTML()
    {
        $currentUser = wp_get_current_user();

        echo 'Hello ' . $currentUser->user_nicename . '. Today is ' . date('d/m/Y');
    }
}

$myOwnCustomDashboardWidget = new MyOwnCustomDashboardWidget();
