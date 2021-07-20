<?php

/**
 * @package NTHPlugin
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function adminDashboard()
    {
        return require_once("$this->plugin_path/template/admin.php");
    }
}
