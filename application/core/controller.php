<?php

class Controller
{

    public $model;
    public $view;
    public $host;

    function __construct()
    {
        $this->view = new View();
    }

    function action_index()
    {
        // todo
    }
}
