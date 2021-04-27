<?php

class Controller_Services extends Controller
{
    function __construct()
    {
        $this->model = new Model_Services();
        $this->view = new View();
        $this->host = 'http://' . $_SERVER['HTTP_HOST'] . '/';;
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('services_view.php', 'template_view.php', $data);
    }

    function action_choice()
    {
        if ($_POST) {
            $this->model->get_choice($_POST, $_SESSION['id']);
            header('Location:' . $this->host, 'services');
        }
    }
}