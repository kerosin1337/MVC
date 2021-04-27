<?php

class Model
{
    function db()
    {
        require 'application/connection.php';

        $link = mysqli_connect($host, $user, $password, $database)
        or die("Ошибка " . mysqli_error($link));
        return $link;
    }

    public function get_data()
    {

    }
}