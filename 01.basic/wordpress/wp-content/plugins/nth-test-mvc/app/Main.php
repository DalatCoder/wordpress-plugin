<?php

namespace MyApp;

use WPMVC\Bridge;

/**
 * Main class.
 * Bridge between WordPress and App.
 * Class contains declaration of hooks and filters.
 *
 * @author Trong Hieu <hieuntctk42@gmail.com>
 * @package nth-app
 * @version 1.0.0
 */
class Main extends Bridge
{
    /**
     * Declaration of public WordPress hooks.
     */
    public function init()
    {
        /*
        $this->add_action('posts_request', 'AquaController@onSubmit');
        $this->add_action('admin_post_nopriv_process_form', 'AquaController@onSubmit');
        $this->add_action('admin_post_nopriv_aqua_config', 'AquaController@onSubmit');
        $this->add_action('admin_post_process_form', 'AquaController@onSubmit');
        $this->add_action('admin-post', 'AquaController@onSubmit');
        $this->add_action('admin-post_aquaaction', 'AquaController@onSubmit');
        $this->add_action('admin_post_aqua_config', 'AquaController@onSubmit');
        */

        $this->add_action('admin_post_nopriv_aquafina', 'AquaController@onSubmit');
        $this->add_action('admin_post_aquafina', 'AquaController@onSubmit');
    }
    /**
     * Declaration of admin only WordPress hooks.
     * For WordPress admin dashboard.
     */
    public function on_admin()
    {
        $this->add_action('admin_menu', 'AquaController@init');
    }
}
