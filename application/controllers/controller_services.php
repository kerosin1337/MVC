<?php

class Controller_Services extends Controller
{
    // функция для создания экземпляров
    function __construct()
    {
        $this->model = new Model_Services();
        $this->view = new View();
        $this->host = 'http://' . $_SERVER['HTTP_HOST'] . '/';;
    }

    // страница услуг
    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('services_view.php', 'template_view.php', $data);
    }

    // функция для выбора услуги
    function action_choice()
    {
        if ($_POST) {
            $this->model->get_choice($_POST, $_SESSION['id']);
            header('Location:' . $this->host, 'services');
        }
    }
}