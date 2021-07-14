
<?php

/*
Plugin Name: 09 Hide Menu Item
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class NTHMyAmazingWidgetBooster
{
    function __construct()
    {
        add_action('widgets_init', [$this, 'registerWidget']);
    }

    function registerWidget()
    {
        register_widget('NTHMyAmazingWidget');
    }
}

$instance = new NTHMyAmazingWidgetBooster();

class NTHMyAmazingWidget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Base ID of your widget
            'nth_my_amzing_widget',

            // Widget name will appear in UI
            __('NTH Amazing widget', 'wpb_widget_domain'),

            // Widget description
            array('description' => __('Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain'),)
        );
    }

    // Render widget on client
    public function widget($args, $instance)
    {
    }

    // Render widget form on admin
    public function form($instance)
    {
    }

    // Update value from form on admin
    public function update($new_instance, $old_instance)
    {
    }
}
