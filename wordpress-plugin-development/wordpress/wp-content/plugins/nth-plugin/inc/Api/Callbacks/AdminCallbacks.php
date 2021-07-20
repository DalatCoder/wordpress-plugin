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

    public function adminCPT()
    {
        return require_once("$this->plugin_path/template/cpt.php");
    }

    public function adminTaxonomy()
    {
        return require_once("$this->plugin_path/template/taxonomy.php");
    }

    public function adminWidget()
    {
        return require_once("$this->plugin_path/template/widget.php");
    }

    // Validate the input 
    // Sanitize
    // Hash password
    // Check already email...
    public function nthOptionsGroup($input)
    {
        return $input;
    }

    public function nthAdminSection()
    {
        echo 'Check this beautiful section';
    }

    public function nthAdminTextExample()
    {
        $value = esc_attr(get_option('text_example'));
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write something here">';
    }
}
