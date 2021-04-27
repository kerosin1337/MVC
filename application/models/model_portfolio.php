<?php

class Model_Portfolio extends Model
{

    public function get_data()
    {
        $link = $this->db();
        $query = 'SELECT * FROM portfolio';
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $arr = [];
        foreach ($result as $item) {
            $arr[] = array(
                'id' => $item['id'],
                'Year' => $item['years'],
                'Site' => $item['site'],
                'Description' => $item['description'],

            );
        }
        mysqli_close($link);
        return $arr;
    }

    public function get_add($post)
    {
        $link = $this->db();
        $query = "INSERT INTO portfolio (years, site, description) VALUES (" . $post['year'] . ", '" . $post['site'] . "', '" . $post['description'] . "')";
        mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
    }

    public function get_edit($post)
    {
        $link = $this->db();
        $query = "UPDATE portfolio SET years = " . $post['year'] . ", site = '" . $post['site'] . "', description = '" . $post['description'] . "' WHERE id = " . $post['ID'];
        mysqli_query($link, $query) or die($query . mysqli_error($link));
        mysqli_close($link);
    }

    public function get_delete($post)
    {
        $link = $this->db();
        $query = "DELETE FROM portfolio WHERE id = " . $post['delID'];
        mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
    }
}
