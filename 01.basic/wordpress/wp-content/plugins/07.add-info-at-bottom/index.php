<?php

/*
Plugin Name: 07 Append Extra Information at bottom of post editting page
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class NTNAppendPostEditingUI
{
    function __construct()
    {
        add_action('edit_form_advanced', [$this, 'renderHTML']);
    }

    function renderHTML()
    {
        echo "
            <div style='background: #fff; margin-bottom: 25px; padding: 10px 20px; border: none; border-radius: 10px; box-shadow: 0px 5px 10px rgba(0,0,0,.4);'>
                <h3>Render Extra Information</h3>
            </div>
            <div style='background: #fff; padding: 10px 20px; border: none; border-radius: 10px; box-shadow: 0px 5px 10px rgba(0,0,0,.4);'>
                <h3>Post Writing Guideline</h3>
            </div>
        ";
    }
}

$instance = new NTNAppendPostEditingUI();
