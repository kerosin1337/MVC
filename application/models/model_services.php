<?php

class Model_Services extends Model
{
    private function get_user_service($id)
    {
        $user_model = new Model_User();
        $link = $this->db();
        $query = 'SELECT * FROM user_services WHERE services_id = ' . $id;
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $arr = [];
        foreach ($result as $item) {
            $arr[] = array(
                'user' => $user_model->get_current_user($item['user_id'])
            );
        }
        mysqli_close($link);
        return $arr;
    }

    public function get_data()
    {
        $link = $this->db();
        $query = 'SELECT * FROM services';
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $arr = [];
        foreach ($result as $item) {
            $arr[] = array(
                'id' => $item['id'],
                'title' => $item['title'],
                'body' => $item['body'],
                'image' => $item['image'],
                'enrolled' => $this->get_user_service($item['id'])
            );
        }
        mysqli_close($link);
        return $arr;
    }

    public function get_choice($post, $id)
    {
        $link = $this->db();
        $query = "INSERT INTO user_services (user_id, services_id) VALUES (" . $id . ", " . $post['servID'] . ")";
        mysqli_query($link, $query) or die($query . mysqli_error($link));
    }

    public function get_add($post, $image)
    {
        $link = $this->db();
        $uploaddir = 'images/';
        $uploadfile = $uploaddir . basename($image);
        move_uploaded_file($image, $uploadfile);
        if ($image)
            $query = "INSERT INTO services (title, body, image) VALUES ('" . $post['title'] . "', '" . $post['body'] . "', '" . $image . "')";
        else
            $query = "INSERT INTO services (title, body, image) VALUES ('" . $post['title'] . "', '" . $post['body'] . "', NULL)";
        mysqli_query($link, $query) or die($query . mysqli_error($link));
        mysqli_close($link);
    }

    public function get_edit($post, $image)
    {
        $link = $this->db();
        $uploaddir = 'images/';
        $uploadfile = $uploaddir . basename($image);
        move_uploaded_file($image, $uploadfile);
        if ($image)
            $query = "UPDATE services SET title = '" . $post['title'] . "', body = '" . $post['body'] . "', image = '" . $image . "' WHERE id = " . $_POST['ID'];
        else
            $query = "UPDATE services SET title = '" . $post['title'] . "', body = '" . $post['body'] . "', image = NULL WHERE id = " . $post['ID'];
        mysqli_query($link, $query) or die($query . mysqli_error($link));
        mysqli_close($link);
    }

    public function get_delete($post)
    {
        $link = $this->db();
        $query = "DELETE FROM services WHERE id = " . $post['delID'];
        mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
    }
}