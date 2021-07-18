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

- For security, create new file `index.php` with the following content

```php
  <?php
  // Silence is golden.
```

When someone try to directly access to the plugin folder, they will be redirected to the `index.php`.
