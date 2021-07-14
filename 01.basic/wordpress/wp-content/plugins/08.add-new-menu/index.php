<?php

/*
Plugin Name: 08 Add New Menu
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class NTHAddNewMenuItem
{
    function __construct()
    {
        add_action('admin_menu', [$this, 'setCustomField']);
    }

    function setCustomField()
    {
        $capability = 'manage_options';
        $customMenuPageQueryString = 'custom_menu';
        $quicklinkPageQueryString = 'custom_menu_quick_link';

        add_menu_page(
            'Custom Menu Page',
            'Custom Menu',
            $capability,
            $customMenuPageQueryString,
            [$this, 'saveCustomField'],
            '',
            '25.2'
        );

        add_submenu_page(
            $customMenuPageQueryString,
            'Quick Links',
            'Quick Links',
            $capability,
            $quicklinkPageQueryString,
            [$this, 'getQuickLinks']
        );
    }

    function saveCustomField()
    {

        $fields = ['phone', 'footer_copyright_line', 'blurb'];

        $name_prefix = 'nth_custom_menu_';

        $textareas = ['blurb'];

        echo '<h3>Home Page Content</h3>';
        echo '<form method="post" action="">';

        foreach ($fields as $field) {
            if (isset($_POST[$field])) {
                update_option($name_prefix . $field, $_POST[$field]);
            }

            $value = stripslashes(get_option($name_prefix . $field));
            $label = ucwords(strtolower($field));

            if (in_array($field, $textareas)) {
                echo "
                    <p><label for='$field'>$label</label></p>
                    <textarea rows='5' class='regular-text' id='$field' name='$field'>$value</textarea>
                ";
                continue;
            }

            echo "
                <p><label for='$field'>$label</label></p>
                <input id='$field' name='$field' value='$value' class='regular-text'>
            ";
        }

        echo '<div><input type="Submit"></div>';
        echo '</form>';
    }

    function getQuickLinks()
    {
        echo '<h3>Quick Link Page</h3>';
    }
}

$instance = new NTHAddNewMenuItem();
