<?php
require_once 'application/models/model_portfolio.php';

class Controller_Main extends Controller
{
    function __construct()
    {

        $this->model = array(
            'news' => new Model_News(),
            'portfolio' => new Model_Portfolio(),
            'comments' => new Model_Comments()
        );
        $this->view = new View();
        $this->host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
    }

    function action_index()
    {
        $news = $this->model['news']->get_data();
        $this->view->generate('main_view.php', 'template_view.php', $news);
    }

    function action_add_comment()
    {
        if ($_POST) {
            $this->model['comments']->get_add_comment($_POST);
            header('Location:' . $this->host);
        }
    }

    function action_delete_comment()
    {
        if ($_POST) {
            $this->model['comments']->get_delete_by_id($_POST, $_SESSION['id'], null);
            header('Location:' . $this->host);
        }
    }

    function action_portfolio()
    {
        $data = $this->model['portfolio']->get_data();
        $this->view->generate('portfolio_view.php', 'template_view.php', $data);
    }

    function action_contacts()
    {
        $this->view->generate('contacts_view.php', 'template_view.php');
    }

}