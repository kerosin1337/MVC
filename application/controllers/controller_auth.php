<?php

class Controller_Auth extends Controller
{
    // функция для создания экземпляров
    function __construct()
    {
        $this->model = new Model_User();
        $this->view = new View();
        $this->host = 'http://' . $_SERVER['HTTP_HOST'] . '/';;
    }

    // функция переадресации на страницу авторизации
    function action_index()
    {
        header('Location:' . $this->host . 'auth/login');
    }

    // функция для авторизации
    function action_login()
    {
        // если неавторизован
        if (!isset($_SESSION['hash']) and !isset($_SESSION['id'])) {
            // если метод пост
            if ($_POST) {
                $q = $this->model->get_data_login($_POST, $_SERVER['REMOTE_ADDR']);
                // если админ
                if (isset($_SESSION['is_superuser'])) {
                    header('Location:' . $this->host . 'admin');
                } else {
                    if (!isset($q)) {
                        header('Location:' . $this->host);
                    } else {
                        // если есть ошибки, то вывести ошибки
                        $this->view->generate('login_view.php', 'template_view.php', $q);
                    }
                }
            } else
                $this->view->generate('login_view.php', 'template_view.php', null);

        } else
            header('Location:' . $this->host);
    }

    // функция регистрации
    function action_registration()
    {
        // если неавторизован
        if (!isset($_SESSION['hash']) and !isset($_SESSION['id'])) {
            // если метод пост
            if ($_POST) {
                $q = $this->model->get_data_reg($_POST);
            }
            if (!isset($q)) {
                $this->view->generate('registration_view.php', 'template_view.php', null);
            } else {
                // если нет ошибок
                if ($q == 'success')
                    header('Location:' . $this->host . 'auth/login');
                // вывод ошибки
                $this->view->generate('registration_view.php', 'template_view.php', $q);
            }
        } else
            header('Location:' . $this->host);
    }

    // функция выхода
    function action_logout()
    {
        session_destroy();
        header('Location:' . $this->host);
    }
}