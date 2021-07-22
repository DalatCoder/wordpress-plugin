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
        // echo 'Check this beautiful section';
    }

    public function nthTextExample()
    {
        $value = esc_attr(get_option('nth_text_example'));
        echo '
            <input 
                type="text" 
                id="nth_text_example" 
                class="regular-text" 
                name="nth_text_example" 
                value="' . $value . '" 
                placeholder="Write something here"
                autocomplete="off"
            >';
    }

    public function nthFirstName()
    {
        $value = esc_attr(get_option('nth_first_name'));
        echo '
            <input 
                type="text" 
                id="nth_first_name" 
                class="regular-text" 
                name="nth_first_name" 
                value="' . $value . '" 
                placeholder="Enter your first name"
                autocomplete="off"
            >';
    }

    public function nthLastName()
    {
        $value = esc_attr(get_option('nth_last_name'));
        echo '
            <input 
                type="text" 
                id="nth_last_name" 
                class="regular-text" 
                name="nth_last_name" 
                value="' . $value . '" 
                placeholder="Enter your last name"
                autocomplete="off"
            >';
    }

    public function nthLevel()
    {
        $value = esc_attr(get_option('nth_level'));
?>
        <select name="nth_level" id="nth_level" class="regular-text">
            <option value="0" <?php echo $value == '0' ? 'selected' : ''; ?>>Junior</option>
            <option value="1" <?php echo $value == '1' ? 'selected' : ''; ?>>Senior</option>
            <option value="2" <?php echo $value == '2' ? 'selected' : ''; ?>>Project Manager</option>
        </select>
<?php
    }
}
