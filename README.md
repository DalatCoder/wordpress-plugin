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

### 1. Plugin #1: Display a message to all writers in the WordPress backend

Create plugin to show an information box on `create-post` page

```php
  add_action('all_admin_notices', [$this, 'displayMessageAtTop']);

  function displayMessageAtTop() {
    if (strpos($_SERVER['REQUEST_URI'], 'post-new') > 0 || strpos($_SERVER['REQUEST_URI'], 'post.php') > 0) {
      // HTML in here
    }
  }
```
