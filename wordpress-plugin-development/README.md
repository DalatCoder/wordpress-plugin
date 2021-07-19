# WordPress Plugin Development Tutorials

> Based on: [https://youtu.be/Z7QfH-s-15s](https://youtu.be/Z7QfH-s-15s)

## Create new plugin

- Navigate to folder: `wp-content/plugins`
- Create new folder with the desired plugin name (must be the unique name)
- Create new `php` file with the same name inside this folder

  - Plugin metadata

  ```php
    <?php

    /**
    * @package NTHPlugin
    */

    /**
    * Plugin Name: NTH Plugin
    * Plugin URI: http://nth.com
    * Description: This is my first attempt on writting a custom Plugin. <strong>Trong Hieu</strong>
    * Version: 1.0.0
    * Author: Nguyen Trong Hieu
    * Author URI: http://nth.com
    * License: GPLv2 or later
    * Text Domain: nth-plugin
    */
  ```

- For security

  - Create new file `index.php` with the following content

  ```php
    <?php
    // Silence is golden.
  ```

  When someone try to directly access to the plugin folder, they will be redirected to the `index.php`.

  - Check condition in main plugin file

  ```php
    if (!defined('ABSPATH')) {
        die;
    }
  ```

  'ABSPATH` will be defined by WordPress, if someone try to access our website
  from another source, this constant won't be defined.

  or

  ```php
    defined('ABSPATH') or die('Hey, you can\'t access this file, you silly human!');
  ```

- WordPress automatically trigger 3 default action for a plugin

  - `activation`

    - Create custom post type
    - Flush rewrite rules

    ```php
      register_activation_hook(__FILE__, array($instance, 'activate'));
    ```

  - `deactivation`

    - Flush rewrite rules

    ```php
      register_deactivation_hook(__FILE__, array($instance, 'deactivate'));
    ```

  - `uninstall`
    - Delete custom post type
    - Delete all plugin data from DB

- `flush rewrite rules`:

  - Makes WordPress be awared of that something've just happened in the DB
  - Need to refresh, need to flush the rewrite rules
  - In order to properly reading new stuff

- Trigger `uninstall` hook

  - Create new file named: `uninstall.php`
  - WordPress will automatically call this file when uninstalling the plugin

  - Security check:

  ```php
    defined('WP_UNINSTALL_PLUGIN') or die('Hey, what are you doing here? You silly human!');
  ```

  - Clear data

  ```php
    $books = get_post(array(
        'post_type'    => 'books',
        'numberposts'  => -1
    ));

    foreach ($books as $book) {
        wp_delete_post($book->ID, false); // trashed the data || true: force delete
    }
  ```

  - If custom post type have `custom_metabox`, `custom_taxonomies`, then using `$wpdb`.

    - Dangerous
    - Execute SQL queries
    - Access the database via SQL

    ```php
      global $wpdb;
      $wpdb->query("DELETE FROM wp_posts WHERE post_type = 'book'");
      $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
      $wpdb->query("DELETE FROM wp_term_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
    ```

- Enqueue Custom Script
  - JavaScript
  - CSS

## Plugin 101 Series

Full list of sections and features we will build during the serices of tutorials

- Modular Administration Area
- Custom Post Type Manager
- Custom Taxonomy Manager
- Widget to Upload and Diaply media in sidebars
- Post and Pages Gallery integration
- Testimonial section: Comment in the front-end, admin can approve comments, select which comments to display
- Custom template sections
- Ajax based Login/Register system
- Membership protected area
- Chat system
