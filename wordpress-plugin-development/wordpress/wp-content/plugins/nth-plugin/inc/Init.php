<?php

/**
 * @package NTHPlugin
 */

namespace Inc;

final class Init
{
    /**
     * Store all the classes inside an array
     * @return array Full list of classes
     */
    public static function get_services()
    {
        return [
            Pages\Admin::class,
            Base\Enqueue::class
        ];
    }

    /**
     * Loop through the classes, initialize them, 
     * and call the register() method if it exists
     * @return 
     */
    public static function register_services()
    {
        foreach (self::get_services() as $class) {
            $service = self::instantiate($class);

            if (method_exists($service, 'register')) {
                $service->register();
            }
        }
    }

    /**
     * Initialize the class 
     * @param   class   $class      class from the services array
     * @return  class   instance    new instance of the class
     */
    private static function instantiate($class)
    {
        $service = new $class();
        return $service;
    }
}


/*

if (!class_exists('NTHPlugin')) {
    class NTHPlugin
    {
        public $plugin;

        function __construct()
        {
            $this->plugin = plugin_basename(__FILE__);
        }

        function register_admin_scripts()
        {
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));

            add_action('admin_menu', array($this, 'add_admin_pages'));

            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        }

        function settings_link($links)
        {
            $settings_link = '<a href="admin.php?page=nth_plugin">Settings</a>';
            array_push($links, $settings_link);
            return $links;
        }

        function add_admin_pages()
        {
            add_menu_page('NTH Plugin', 'NTH Plugin', 'manage_options', 'nth_plugin', array($this, 'admin_index'), 'dashicons-store', 110);
        }

        function admin_index()
        {
            // Require template

            require_once plugin_dir_path(__FILE__) . 'template/admin.php';
        }

        function register_client_scripts()
        {
            add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        }

        function activate()
        {
            // Generated a custom post type
            $this->custom_post_type();

            // Flush rewrite rules
            flush_rewrite_rules();
        }

        function deactivate()
        {
            // Flush rewrite rules
        }

        function custom_post_type()
        {
            register_post_type('book', [
                'public' => true,
                'label' => 'Books'
            ]);
        }

        function enqueue()
        {
            // enqueue all our scripts
            wp_enqueue_style('mypluginstyle', plugins_url('/assets/style.css', __FILE__), [], bin2hex(random_bytes(10)));
            wp_enqueue_script('mypluginscript', plugins_url('/assets/script.js', __FILE__), [], bin2hex(random_bytes(10)), true);
        }
    }

    $instance = new NTHPlugin();
    $instance->register_admin_scripts();

    // activate | the same as add_action('<action>', 'function');
    register_activation_hook(__FILE__, array($instance, 'activate'));

    // deactivate
    register_deactivation_hook(__FILE__, array($instance, 'deactivate'));
}
*/
