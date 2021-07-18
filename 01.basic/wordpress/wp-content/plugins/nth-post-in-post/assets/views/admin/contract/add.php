<?php

/**
 * admin.contract.add view.
 * WordPress MVC view.
 *
 * @author Trong Hieu <https://github.com/dalatcoder>
 * @package nth-post-in-post
 * @version 1.0.0
 */
?>

<h1>Them hop dong moi</h1>

<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
    <input type="hidden" name="action" value="add_contract">
    <div>
        <div><label for="title">Title</label></div>
        <input type="text" name="title" id="title" value='' autocomplete="off">
    </div>
    <div>
        <div><label for="content">Content</label></div>
        <textarea name="content" id="content"></textarea>
    </div>
    <div>
        <input type="submit" name="submit" value="Add New Contract">
    </div>
</form>
