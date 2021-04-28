<?php
require_once 'application/models/model_services.php';
require_once 'application/models/model_portfolio.php';

class Controller_Admin extends Controller
{
    // функция для создания экземпляров
    function __construct()
    {
        $this->model = array(
            'users' => new Model_User(),
            'portfolio' => new Model_Portfolio(),
            'news' => new Model_News(),
            'services' => new Model_Services(),
            'comments' => new Model_Comments()
        );
        $this->view = new View();
        $this->host = 'http://' . $_SERVER['HTTP_HOST'] . '/';;
    }

    // страница админа
    function action_index()
    {
        $userdata = $this->model['users']->get_current_user($_SESSION['id']);
        if ($userdata['is_superuser'] == '1') { // проверка на админа
            $data = array(
                'portfolio' => $this->model['portfolio']->get_data(),
                'users' => $this->model['users']->get_data(),
                'news' => $this->model['news']->get_data(),
                'services' => $this->model['services']->get_data()
            );
            $this->view->generate('admin_view.php', 'template_view.php', $data);
        } else {
            $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
            header('Location:' . $host);
        }
    }

    // функция для добавления портфолио
    function action_add_port()
    {
        if ($_POST) {
            $this->model['portfolio']->get_add($_POST);
            header('Location:' . $this->host . 'admin#portfolio');
        }
    }

    // функция для редактирования портфолоио
    function action_edit_port()
    {
        if ($_POST) {
            $this->model['portfolio']->get_edit($_POST);
            header('Location:' . $this->host . 'admin#portfolio');
        }
    }

    // функция для удаляения портфолио
    function action_delete_port()
    {
        if ($_POST) {
            $this->model['portfolio']->get_delete($_POST);
            header('Location:' . $this->host . 'admin#portfolio');
        }
    }

    // функция для добавления новости
    function action_add_news()
    {
        if ($_POST) {
            $this->model['news']->get_add($_POST, $_FILES['image']['name'], $_SESSION['id']);
            header('Location:' . $this->host . 'admin#news');
        }
    }

    // функция для редактирования новостей
    function action_edit_news()
    {
        if ($_POST) {
            $this->model['news']->get_edit($_POST, $_FILES['image']['name'], $_SESSION['id']);
            header('Location:' . $this->host . 'admin#news');
        }
    }

    // функция для удаляения новостей
    function action_delete_news()
    {
        if ($_POST) {
            $this->model['news']->get_delete($_POST);
            header('Location:' . $this->host . 'admin#news');
        }
    }

    // функция для удаляения комментария
    function action_delete_comment()
    {
        if ($_POST) {
            $this->model['comments']->get_delete_by_id($_POST, $_SESSION['id'], $_SESSION['is_superuser']);
            header('Location:' . $this->host . 'admin#news');
        }
    }

    // функция для добавления услуги
    function action_add_services()
    {
        if ($_POST) {
            $this->model['services']->get_add($_POST, $_FILES['image']['name']);
            header('Location:' . $this->host . 'admin#services');
        }
    }

    // функция для редактирования услуги
    function action_edit_services()
    {
        if ($_POST) {
            $this->model['services']->get_edit($_POST, $_FILES['image']['name']);
            header('Location:' . $this->host . 'admin#services');
        }
    }

    // функция для удаляения услуги
    function action_delete_services()
    {
        if ($_POST) {
            $this->model['services']->get_delete($_POST);
            header('Location:' . $this->host . 'admin#services');
        }
    }

    // функция для добавления пользователя
    function action_add_user()
    {
        if ($_POST) {
            $this->model['users']->get_add($_POST);
            header('Location:' . $this->host . 'admin#users');
        }
    }

    // функция для редактирования пользователя
    function action_edit_user()
    {
        if ($_POST) {
            $this->model['users']->get_edit($_POST);
            header('Location:' . $this->host . 'admin#users');
        }
    }

    // функция для удаления пользователя
    function action_delete_user()
    {
        if ($_POST) {
            $this->model['users']->get_delete($_POST);
            header('Location:' . $this->host . 'admin#users');
        }
    }
}