# Wordpress Plugin Development

> A WordPress plugin is an extension of the WordPress core installation.

What exactly is the architecture of a WordPress plugin?

This consists of only 2 things:

- The `hook`: all plugins have a hook at least one or more. You can have as many hook as you want.
  And actually some WordPress plugins don't have any hook, they just have some
  tempate tags.

  - `filter hook`
  - `action hook`

- The `callback` function: hook must to be attached to callback function, which is where all the
  cool PHP code goes

So, in a nutshell, the WordPress plugin architecture consists of: `filter_hook` or `action_hook` and `callback function`

## 1. Overview

### 1.1. Plugin Architecture

#### 1. Plugin metadata

```php
/**
 * Plugin Name: <plugin_name>
 * Description: <plugin_description>
 * Version: <plugin_version>
 * Author: <plugin_author>
 */
```

#### 2. Hooks

Action hooks

```php
add_action('<hook>', '<callback_fn>');
```

Filter hooks

```php
add_filter('<hook>', '<callback_fn>');
```

#### 3. Callback Functions

Function attached to a specific hook.

### 1.2. Theme vs. Plugin

- Almost the same
- The code are almost the same

- Themes handle frontend of the website
- Plugins extend the code of the WordPress core installation

### 1.3. List of hooks in this course

In a nutshell

- `Filter hooks` change the content such as posts and pages
- `Action hooks` change WordPress' behavior and makes it do something or makes it stop doing something

As you can see from the list, we learn a lot more action hooks. That's just the way
WordPress is. It has many more action hooks than filter hooks.

Filter hooks:

- `the_content`
- `admin_footer_text`
- `body_class`

Action hooks:

- `admin_menu`
- `init`
- `admin_init`
- `admin_notices`
- `wp_dashboard_setup`
- `admin_bar_menu`
- `wp_enqueue_scripts`
- `show_user_profile`
- `edit_user_profile`
- `personal_options_update`
- `edit_user_profile_update`
- `login_form_login`
- `widgets_init`
- `customize_register`
- `after_setup_theme`

### 1.4. Example: plugin to change `Wordpress` to `WordPress`

```php
/*
 * Plugin Name: Fix WordPress
 * Description: Change the spelling of WordPress to capital P
 * Version: 1.0
 * Author: 2nth
 */

class NTHFixWordPress
{
  function __construct()
  {
    add_filter('the_content', [$this, 'fixSpelling']);
  }

  function fixSpelling($content)
  {
    $content = str_replace('Wordpress', 'WordPress', $content);
    return $content;
  }
}

$nthFixWordPress = new NTHFixWordPress();
```

### 1.5. Inserting `post` and `page` programmatically

```php
$args = [
  'post_title' => 'Sample post',
  'post_content' => 'This is the content',
  'post_status' => 'publish',
  'post_type' => 'post' // 'post' || 'page'
];

$postId = wp_insert_post($args);

echo $postId;

```

### 1.6. Expanding the user profile page with additional section and field

```php
  add_action('show_user_profile', [$this, 'showExtraProfileFields']);
  # add_action('edit_user_profile', [$this, 'showExtraProfileFields']);

  add_action('personal_options_update', [$this, 'saveExtraProfileFields']);
  # add_action('edit_user_profile_update', [$this, 'saveExtraProfileFields']);
```

### 1.7. Extracting WordPress setting from Themes and Plugins with `bloginfo`

- `bloginfo(name)`: Get `Site Title` field in Admin Setting Page
- `bloginfo(description)`: Get `Tagline` field in Admin Setting Page
- `bloginfo(template_url)`: Get path to template folder

  ```php
    <header>
      <link rel="stylesheet" type="text/css" href="<?= bloginfo(template_url) ?>/css/style.css">
    </header>
  ```

- `bloginfo(wpurl)`: Get URL to the home page
- `bloginfo(version)`: Get version
- `bloginfo(language)`: Get language

### 1.8 Log User When Login to WordPress Admin

```php
  add_action('admin_notices', [$this, 'showNotice']);
```

```php
  add_action('wp_login', [$this, 'createUserLogEntry'], 10, 2);
```

## 2. Plugins Allow Developers To Take Control of WordPress Adminnistrative Back End

Take control of WordPress backend

### 2.1. Plugin #1: Display a message to all writers in the WordPress backend

Create plugin to show an information box on `create-post` page

```php
  add_action('all_admin_notices', [$this, 'displayMessageAtTop']);

  function displayMessageAtTop() {
    if (strpos($_SERVER['REQUEST_URI'], 'post-new') > 0 || strpos($_SERVER['REQUEST_URI'], 'post.php') > 0) {
      // HTML in here
    }
  }
```

### 2.2. Create your own custom WordPress Widgets with PHP

```php
class MyOwnCustomDashboardWidget
{
    function __construct()
    {
        add_action('wp_dashboard_setup', [$this, 'addCustomWidget']);
    }

    function addCustomWidget()
    {
        wp_add_dashboard_widget('custom_help_widget', 'Good Morning', [$this, 'generateHTML']);
    }

    function generateHTML()
    {
        $currentUser = wp_get_current_user();
        echo 'Hello ' . $currentUser->user_nicename . '. Today is ' . date('d/m/Y');

        // HTML in here!
    }
}
```

### 2.3. Programatically changing the footer text in the administrative backend

```php
class NTHChangingFooterText
{
    function __construct()
    {
        add_action('admin_footer_text', [$this, 'changeFooter']);
    }

    function changeFooter()
    {
        echo "Changing Footer Content";
    }
}
```

### 2.4. Programmatically activate plugins without having to click the activate link

Put that code in `functions.php` in current actived theme folder

Auto active plugin without logging to WordPress Admin in Production environment.

```php
function run_activate_plugin($plugin)
{
  $current = get_option('active_plugins');
  $plugin = plugin_basename(trim($plugin));

  if (!in_array($plugin, $current)) {
    $current[] = $plugin;

    sort($current);

    do_action('activate_plugin', trim($plugin));
    update_option('activate_plugins', $current);
    do_action('activate_' . trim($plugin));
    do_action('activated_plugin', trim($plugin));
  }

  return null;
}

# run_activate_plugin('foldername/plugin.php');
```

### 2.5. Adding messages to writers at the end of any post editing form

```php
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
    ";
  }
}

$instance = new NTNAppendPostEditingUI();

```

## 3. WordPress API Programming Commonly Used in Plugin

### 3.1. Introduction to the WordPress Option API

- `add_option(<field_name>, <field_value>)`: Option don't have `autoload`, we need
  to `manual` call

- `update_option(<field_name>, <field_value>)`: Almost does the samething as
  `add_option`

  - Update an existing option
  - If the `option` does exist, it create automatically

- `get_option(<field_name>)`: Get option value by `key`
- `delete_option(<field_name>)`: Delete an option

Multisites option API

- `add_site_option`
- `update_site_option`
- `get_site_option`
- `delete_site_option`

### 3.2. WordPress Transient API For WordPress Websites and WordPress Multisites

Module agenda

- WordPress Transient API
- How to use it to persist data

WordPress Transient API

- Similiar to cookie, but
  - Cookies can be cleared by a web browser
  - Transient stored in WordPress, so it can't be cleared by client

`set_transient()` using `wp_cache_set()` and `mysql` database.
WP Cache API using `$GLOBAL`(global session for application).
`Cookies` and `Session` saves data only for one current user(cookies in browser, sessions on backend).
I think better using `set_transient()`, it has nice hooks and save all data global, even on site disabled cache.

Answer at: [WordPress Stackexchange](https://wordpress.stackexchange.com/questions/250751/wp-transients-wp-object-cache-vs-sessions-cookies)

```php
  $transient_id = 'endOfMonthMessage';
  $message = '<p>At the end of the month, you need to review your subscription</p>';
  $expiry = 60 * 60 * 24 * 5; // 5 days

  set_transient($transient_id, $message, $expiry); // Expired after $expiry time

  // or nerver expired: set_transient($transient_id, $message, $expiry);

  echo get_transient($transient_id);

  delete_transient($transient_id);
```

- `set_transient`: Set new transient
- `get_transient`: Get transient value by the given key
- `delete_transient`: Delete transient with the given key

For multisites transient

- `set_site_transient()`
- `delete_site_transient()`
- `get_site_transient()`

### 3.3. Introduction to Metadata API

> Powerfull and easy to use API in WordPress

Get metadata for everything:

- `post`
- `user`
- `comment`

WordPress comes with 3 metadata tables

- `commentmeta`
- `postmeta`
- `usermeta`

```php
  $metadata_type = 'user';
  $object_id = 1; // In current case, this is the user id
  $meta_key = 'first_name';
  $is_array_format = false;

  $firstname = get_metadata($metadata_type, $object_id, $meta_key, $get_single);
```

Metadata API

- `get_metadata`
- `update_metadata`
- `add_metadata`
- `delete_metadata`

### 3.4. Widgets API | An introduction in creating a simple widget

```php
class NTHMyAmazingWidgetBooster
{
    function __construct()
    {
        add_action('widgets_init', [$this, 'registerWidget']);
    }

    function registerWidget()
    {
        register_widget('NTHMyAmazingWidget');
    }
}

$instance = new NTHMyAmazingWidgetBooster();

class NTHMyAmazingWidget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            // Base ID of your widget
            'nth_my_amzing_widget',

            // Widget name will appear in UI
            __('NTH Amazing widget', 'wpb_widget_domain'),

            // Widget description
            array('description' => __('Sample widget based on WPBeginner Tutorial', 'wpb_widget_domain'),)
        );
    }

    // Render widget on client
    public function widget($args, $instance)
    {
    }

    // Render widget form on admin
    public function form($instance)
    {
    }

    // Update value from form on admin
    public function update($new_instance, $old_instance)
    {
    }
}

```

### 3.5. Introduction to Theme Customization API

Open Admin Dashboard, click Appearance and Customize

```php
add_action('customize_register', 'theme_customizer_register');

function theme_customizer_register($wp_customize)
{
  $wp_customize->add_section('social_media', [
    'title' => 'Social Media',
    'priority' => 25,
  ]);

  $wp_customize->add_setting('facebook', [
    'default' => 'https://facebook.com',
    'transport' => 'refresh' // When user enter value, submit and refresh to see new update
  ]);

  $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'txtFacebookLink', [
        'label' => 'Facebook Link',
        'section' => 'social_media',
        'settings' => 'facebook',
        'type' => 'text'
      ]
    )
  );
}
```

Flows

- Create sections
- Create settings
- Create controls

### 3.6 Shortcode API

> As a security precaution, running PHP inside WordPress content is forbidden;
> to allow dynamic interactions with the content, Shortcodes were presented in WordPress version 2.5.
> Shortcodes are macros that can be used to perform dynamic interactions with the content.
> i.e creating a gallery from images attached to the post or rendering a video.

Learn more at: [WordPress Plugin](https://developer.wordpress.org/plugins/shortcodes/)

Shortcode can be added to both Plugin and Theme

Example: Add shortcode to display Date and Time in every post

```php
add_shortcode('date-and-time', 'show_date_and_time');

function show_date_and_time()
{
  return date('d/m/Y H:i:s');
}
```

In `index.php` of specific theme

```php
<?php echo "The date/time is " . do_shortcode('[date-and-time]'); ?>
```

Working with Shortcode API Attributes

```php
add_shortcode('date-and-time', 'show_date_and_time');

function show_date_and_time($attributes)
{
  $a = shortcode_attr([
    'color' => '#FF0000',
  ], $attributes);

  $color = $a['color'];

  return '<span style="color: ' . $color . '">' . date('d/m/Y H:i:s') . '</span>';
}

// Override default color attribute
<?php echo "The date/time is " . do_shortcode('[date-and-time] color="#0F0"'); ?>
```

## 4. Hooks | The most important tool in Your WordPress Plugin Development Toolbox

Hooks are basically a way of writing extensions.

Extensions are themes and plugins.

When you want to make changes to WordPress, we can not touch the WordPress core.
Because when we update we're going to lose all of our changes.

So hooks work with extensions and extensions actually live outside of the
WordPress core installation.

In this module, we will discuss 2 type of hooks: `action` hooks and `filter` hooks.

- `action` hook: It does something to the WordPress core installation without us
  modifying the WordPress core files.

- `filter` hook: It will change the WordPress information that you see on the
  web page in some way. Such as I use the `the_content` and change that content
  any way I want.

### 4.1. Write Plugin to automatically add author information at bottom of every post page

```php
add_filter('the_content', 'add_author_information');

function add_author_information($content) {
  $content .= '<hr>';
  $content .= 'Visit the author\'s website at: https://authorwebsite.com';

  return $content;
}
```

### 4.2. Filter hook adding CSS classes to the HTML body tag

```php
add_filter('body_class', 'customize_body_class');

function customize_body_class($classes) {
  array_unshift($classes, 'my-new-class-name');
  return $classes;

  // $classes[] = 'my-new-class-name' || array_push($classes, 'my-new-class-name')
}
```

### 4.3. `init` and `admin_init` hooks

- `init`: It was called after the entire WordPress core has started and has
  actually loaded

  - Load the global `$wpdb`
  - Load and/or register custom post types
  - Create menu
  - Load another hooks if needed

- `admin_init`: It was called after the backend has actually loaded

  - Process admin info
  - Display messages to the admin users
  - Display the top black bar

### 4.4. Using hooks to add a Facebook share button to any post or page

```php
add_filter('the_content', function ($content) {

  $content .= 'Facebook share plugin goes here';

  return $content;
});
```

Put `wp-head()` inside `header.php` file in theme folder

```php
add_action('wp_head', function () {
  ?>

  // Inject Facebook share button scripts

  <?php
});
```

## 5. Developing WordPress Plugin

A plugin is just a PHP file

Flow

- Start any PHP file
- Save the PHP file in the `wp-content/plugins` directory
- Add plugin metadata
  - Plugin Name
  - Plugin URI
  - Description (optional)
  - Version (numerical)
  - Author
  - Author URI
- Write hook
- Write callback function

### 5.1. Plugin to display `hello-world` after every page and post

```php
// Plugin metadata

add_filter('the_content', function ($content) {
  return $content . '<p>Hello World</p>';
});
```

### 5.2. Plugin to display feature image centered

```php
add_filter('the_content', function ($content) {
  $id = get_the_ID();
  $title = get_the_title();

  $feature_image = get_the_post_thumbnail($id, [512, 512], [
    'alt' => $title,
    'id' => 'featured-image',
    'class' => 'featured-image'
  ]);

  return '<div style="width: 100%; text-align: center;">' . $feature_image . '</div>' . $content;
});
```
