<?php

namespace NthPostInPost;

use WPMVC\Bridge;

/**
 * Main class.
 * Bridge between WordPress and App.
 * Class contains declaration of hooks and filters.
 *
 * @author Trong Hieu <https://github.com/dalatcoder>
 * @package nth-post-in-post
 * @version 1.0.0
 */
class Main extends Bridge
{
    /**
     * Declaration of public WordPress hooks.
     */
    public function init()
    {
    }
    /**
     * Declaration of admin only WordPress hooks.
     * For WordPress admin dashboard.
     */
    public function on_admin()
    {
        $this->add_action('admin_menu', 'MyController@init');

        $this->add_action('admin_post_add_contract', 'MyController@handleOnAddContract');
        $this->add_action('admin_post_nopriv_add_contract', 'MyController@handleOnAddContract');
    }
}
