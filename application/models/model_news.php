<?php

class Model_News extends Model
{
    // функция получения данных
    public function get_data()
    {
        $model_user = new Model_User();
        $model_comments = new Model_Comments();
        $link = $this->db();
        $query = 'SELECT * FROM news';
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $arr = [];
        foreach ($result as $item) {
            $arr[] = array(
                'id' => $item['id'],
                'title' => $item['title'],
                'body' => $item['body'],
                'image' => $item['image'],
                'creator' => $model_user->get_current_user($item['user_id'])['user_login'],
                'comments' => $model_comments->get_data_by_id($item['id'])
            );
        }
        mysqli_close($link);
        return $arr;
    }

    // функция для добавления новости()
    public function get_add($post, $image, $user_id)
    {
        $link = $this->db();
        if ($image) {
            $uploaddir = 'images/';
            $uploadfile = $uploaddir . basename($image);
            move_uploaded_file($image, $uploadfile);
            $query = "INSERT INTO news (title, body, image, user_id) VALUES ('" . $post['title'] . "', '" . $post['body'] . "', '" . $image . "', " . $user_id . ")";
        } else
            $query = "INSERT INTO news (title, body, image, user_id) VALUES ('" . $post['title'] . "', '" . $post['body'] . "', NULL, " . $user_id . ")";
        mysqli_query($link, $query) or die($query . mysqli_error($link));
        mysqli_close($link);
    }

    // функция для редактирования новости
    public function get_edit($post, $image)
    {
        $link = $this->db();
        if ($image) {
            $uploaddir = 'images/';
            $uploadfile = $uploaddir . basename($image);
            move_uploaded_file($image, $uploadfile);
            $query = "UPDATE news SET title = '" . $post['title'] . "', body = '" . $post['body'] . "', image = '" . $image . "' WHERE id = " . $post['ID'];
        } else
            $query = "UPDATE news SET title = '" . $post['title'] . "', body = '" . $post['body'] . "', image = NULL WHERE id = " . $post['ID'];
        mysqli_query($link, $query) or die($query . mysqli_error($link));
        mysqli_close($link);
    }

    // функция для удаления новости
    public function get_delete($post)
    {
        $link = $this->db();
        $query = "DELETE FROM news WHERE id = " . $post['delID'];
        mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
    }
}