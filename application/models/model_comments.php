<?php

class Model_Comments extends Model
{
    public function get_data_by_id($new_id)
    {
        $model_user = new Model_User();
        $link = $this->db();
        $query = 'SELECT * FROM comments WHERE new_id = ' . $new_id;
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        $arr = [];
        foreach ($result as $item) {
            $arr[] = array(
                'id' => $item['id'],
                'new_id' => $item['new_id'],
                'creator' => $model_user->get_current_user($item['user_id'])['user_login'],
                'body' => $item['body'],
                'user_id' => $item['user_id']
            );
        }
        mysqli_close($link);
        return $arr;
    }

    public function get_add_comment($post)
    {
        $link = $this->db();
        $query = "INSERT INTO comments (new_id, body, user_id) VALUES (" . $post['new_id'] . ", '" . $post['comment'] . "', " . $_SESSION['id'] . ")";
        mysqli_query($link, $query) or die($query . mysqli_error($link));
        mysqli_close($link);
    }

//    public function get_delete_by_id($post, $id)
//    {
//        $link = $this->db();
//        $query = 'DELETE FROM comments WHERE id = ' . $post['commID'] . ' AND user_id = ' . $id;
//        mysqli_query($link, $query) or die($query . mysqli_error($link));
//        mysqli_close($link);
//    }

    public function get_delete_by_id($post, $user_id, $admin)
    {
        $link = $this->db();
        if (isset($admin))
            $query = 'DELETE FROM comments WHERE id = ' . $post['commID'];
        else
            $query = 'DELETE FROM comments WHERE id = ' . $post['commID'] . ' AND user_id = ' . $user_id;
        mysqli_query($link, $query) or die($query . mysqli_error($link));
        mysqli_close($link);
    }
}