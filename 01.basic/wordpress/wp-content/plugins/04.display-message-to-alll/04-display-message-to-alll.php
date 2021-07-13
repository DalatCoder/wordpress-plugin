<?php

/*
Plugin Name: 04 Display Message To All
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: A brief description of the Plugin.
Version: 1.0
Author: tronghieu
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/

class DisplayMessageToAllWriters
{
    function __construct()
    {
        add_action('all_admin_notices', [$this, 'displayMessageAtTop']);
    }

    function displayMessageAtTop()
    {

        $this->writeLog($_SERVER);

        if (strpos($_SERVER['REQUEST_URI'], 'post-new') > 0 || strpos($_SERVER['REQUEST_URI'], 'post.php') > 0) { ?>

            <style>
                .top-box {
                    background: #DDD;
                    border: 1px solid #AAA;
                    border-radius: 7px;
                    padding: 10px 20px;
                }
            </style>

            <div class="wrap" style="margin-top: 50px;">
                <div class="top-box">
                    <h3>This text was inserted by "04 Display Message To All"</h3>
                </div>
            </div>

<?php }
    }

    function writeLog($log)
    {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }
}

$displayMessageToAll = new DisplayMessageToAllWriters();
