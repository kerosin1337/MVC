<?php

class Controller_Profile extends Controller
{
    // функция для создания экземпляров
    function __construct()
    {
        $this->host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        $this->model = new Model_User();
        $this->view = new View();
    }

    // страница профиля
    function action_index()
    {
        // если авторизован
        if (isset($_SESSION['id']) and isset($_SESSION['hash'])) {
            $user = $this->model->get_current_user($_SESSION['id']);
            $this->view->generate('profile_view.php', 'template_view.php', $user);
        } else
            header('Location:' . $this->host);
    }

    // функция для редактирования данных пользователя
    function action_edit()
    {
        if ($_POST) {
            $this->model->get_edit($_POST);
            header('Location:' . $this->host . 'profile');
        }
    }
}