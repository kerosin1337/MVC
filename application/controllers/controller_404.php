<?php

class Controller_404 extends Controller
{
    // контроллер страницы 404
    function action_index()
    {
        $this->view->generate('404_view.php', 'template_view.php');
    }
}