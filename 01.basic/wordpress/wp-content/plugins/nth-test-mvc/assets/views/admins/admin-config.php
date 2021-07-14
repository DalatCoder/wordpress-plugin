<?php

/**
 * admins.admin-config view.
 * WordPress MVC view.
 *
 * @author Trong Hieu <hieuntctk42@gmail.com>
 * @package nth-app
 * @version 1.0.0
 */
?>

<h1>hello my plugin</h1>

<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <input type="hidden" name="action" value="aquafina">
    <div>
        <input type="text" name="aqua_name" value='<?= $name ?>'>
    </div>
    <div>
        <input type="text" name="aqua_description" value='<?= $description ?>'>
    </div>
    <div>
        <input type="submit" name="submit" value="Submit">
    </div>
</form>
