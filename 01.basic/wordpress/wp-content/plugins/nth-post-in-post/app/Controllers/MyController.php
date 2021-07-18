<?php

namespace NthPostInPost\Controllers;

use WPMVC\MVC\Controller;
use NthPostInPost\Models\Contract;

/**
 * MyController
 * WordPress MVC controller.
 *
 * @author Trong Hieu <https://github.com/dalatcoder>
 * @package nth-post-in-post
 * @version 1.0.0
 */
class MyController extends Controller
{
    private $allContractURI = 'all-contract';
    private $addNewContractURI = 'add-new-contract';

    public function init()
    {
        add_menu_page(
            'Quan ly hop dong',
            'Danh sach hop dong',
            'manage_options',
            'all-contract',
            [$this, 'renderContractPage'],
            'dashicons-align-left',
            30
        );

        add_submenu_page(
            'all-contract',
            'Them hop dong',
            'Them hop dong',
            'manage_options',
            'add-new-contract',
            [$this, 'renderAddContractPage']
        );
    }

    function renderContractPage()
    {
        $this->view->get('admin.contract.index');
        $this->view->show('admin.contract.index');
    }

    function renderAddContractPage()
    {
        $this->view->get('admin.contract.add');
        $this->view->show('admin.contract.add');
    }

    public function handleOnAddContract()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            wp_redirect(admin_url("admin.php?page=" . $this->allContractURI));
            return;
        }

        error_log(print_r($_POST, true));

        $title = $_POST['title'];
        $content = $_POST['content'];

        $model = new Contract();
        $model->title = $title;
        $model->content = $content;

        $model->save();

        return wp_redirect(admin_url("admin.php?page=" . $this->allContractURI));
    }
}
