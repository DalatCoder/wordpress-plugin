<?php

/*
Plugin Name: 06 Chaging Footer Text
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class NTHChangingFooterText
{
    function __construct()
    {
        add_action('admin_footer_text', [$this, 'changeFooter']);
    }

    function changeFooter()
    {
        echo "Welcome to 2NTH family";
    }
}

$nthnChangingFooterText = new NTHChangingFooterText();
