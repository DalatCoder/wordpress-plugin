<?php

namespace MyApp\Controllers;

use WPMVC\MVC\Controller;
use MyApp\Models\AquaOption;

/**
 * AquaController
 * WordPress MVC controller.
 *
 * @author Trong Hieu <hieuntctk42@gmail.com>
 * @package nth-app
 * @version 1.0.0
 */
class AquaController extends Controller
{
    public function init()
    {
        add_menu_page('Aqua Config', 'Aqua Config', 'manage_options', 'aqua-config', [$this, 'render']);
    }

    public function render()
    {
        $model = AquaOption::find();

        $name = $model->getName();
        $description = $model->getDescription();

        echo '<pre>' . print_r($model, true) . '</pre>';

        $this->view->get('admins.config');
        $this->view->show('admins.admin-config', [
            'name' => $name,
            'description' => $description
        ]);
    }

    public function onSubmit()
    {
        $model = new AquaOption();

        $name = $_POST['aqua_name'];
        $description = $_POST['aqua_description'];

        $model->name = $name;
        $model->description = $description;

        $model->save();

        header('Location: /wp-admin/admin.php?page=aqua-config');
    }
}
