<div class="wrap">
    <h1>NTH Plugin</h1>

    <?php settings_errors(); ?>

    <form method="POST" action="options.php">
        <?php

        settings_fields('nth_options_group');
        do_settings_sections('nth_plugin');
        submit_button();

        ?>
    </form>
</div>
