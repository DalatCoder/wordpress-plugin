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
