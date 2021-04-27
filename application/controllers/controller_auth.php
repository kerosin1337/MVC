<?php

class Controller_Auth extends Controller
{
    function __construct()
    {
        $this->model = new Model_User();
        $this->view = new View();
        $this->host = 'http://' . $_SERVER['HTTP_HOST'] . '/';;
    }

    function action_index()
    {
        header('Location:' . $this->host . 'auth/login');
    }

    function action_login()
    {
        if (!isset($_SESSION['hash']) and !isset($_SESSION['id'])) {
            if ($_POST) {
                $q = $this->model->get_data_login($_POST, $_SERVER['REMOTE_ADDR']);
                if (isset($_SESSION['is_superuser'])) {
                    if ($_SESSION['is_superuser']) {
                        header('Location:' . $this->host . 'admin');
                    }
                } else {
                    if (!isset($q)) {
                        $this->view->generate('login_view.php', 'template_view.php', null);
                    } else {
                        $this->view->generate('login_view.php', 'template_view.php', $q);
                    }
                }
            } else
                $this->view->generate('login_view.php', 'template_view.php', null);

        } else
            header('Location:' . $this->host);
    }

    function action_registration()
    {
        if (!isset($_SESSION['hash']) and !isset($_SESSION['id'])) {
            if ($_POST) {
                $q = $this->model->get_data_reg($_POST);
            }
            if (!isset($q)) {
                $this->view->generate('registration_view.php', 'template_view.php', null);
            } else {
                if ($q == 'success')
                    header('Location:' . $this->host . 'auth/login');
                $this->view->generate('registration_view.php', 'template_view.php', $q);
            }
        } else
            header('Location:' . $this->host);
    }


    function action_logout()
    {
        session_destroy();
        header('Location:' . $this->host);
    }
}