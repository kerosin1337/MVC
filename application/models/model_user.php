<?php

class Model_User extends Model
{
    public function get_data()
    {
        $link = $this->db();
        $query = 'SELECT * FROM users';
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

        $arr = [];
        foreach ($result as $item) {
            $arr[] = array(
                'id' => $item['user_id'],
                'login' => $item['user_login'],
                'password' => $item['user_password'],
                'ip' => $item['user_ip'],
                'is_superuser' => $item['is_superuser']
            );
        }
        mysqli_close($link);
        return $arr;
    }

    public function get_current_user($id)
    {
        $link = $this->db();
        $query = 'SELECT * FROM users WHERE user_id = ' . $id;
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
        return mysqli_fetch_assoc($result);
    }

    public function get_data_login($post, $user_ip)
    {
        $link = $this->db();
        $query = mysqli_query($link, "SELECT user_id, user_password FROM users WHERE user_login='" . mysqli_real_escape_string($link, $post['login']) . "' LIMIT 1");
        $data = mysqli_fetch_assoc($query);
        function generateCode($length = 6)
        {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
            $code = "";
            $clen = strlen($chars) - 1;
            while (strlen($code) < $length) {
                $code .= $chars[mt_rand(0, $clen)];
            }
            return $code;
        }

        // Сравниваем пароли
        if ($data) {
            if ($data['user_password'] === md5(md5($post['password']))) {
                // Генерируем случайное число и шифруем его
                $hash = md5(generateCode(10));

                if (!empty($post['not_attach_ip'])) {
                    // Если пользователя выбрал привязку к IP
                    // Переводим IP в строку
                    $insip = ", user_ip=INET_ATON('" . $user_ip . "')";
                } else {
                    $insip = '';
                }

                // Записываем в БД новый хеш авторизации и IP
                mysqli_query($link, "UPDATE users SET user_hash='" . $hash . "' " . $insip . " WHERE user_id='" . $data['user_id'] . "'");

                // Ставим куки
//            setcookie("id", $data['user_id'], time() + 60 * 60 * 24 * 30, "/");
//            setcookie("hash", $hash, time() + 60 * 60 * 24 * 30, "/", null, null, true); // httponly !!!
                $_SESSION['id'] = $data['user_id'];
                $_SESSION['hash'] = $hash;
//                $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
//
                if (isset($_SESSION['id']) and isset($_SESSION['hash'])) {
                    $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '" . intval($_SESSION['id']) . "' LIMIT 1");
                    $userdata = mysqli_fetch_assoc($query);


                    if (($userdata['user_hash'] !== $_SESSION['hash']) or ($userdata['user_id'] !== $_SESSION['id'])) {
//                    $_SESSION['id'] = null;
//                    $_SESSION['hash'] = null;
//                    var_dump($userdata);
//                    die;
//                    setcookie("id", "", time() - 3600 * 24 * 30 * 12, "/");
//                    setcookie("hash", "", time() - 3600 * 24 * 30 * 12, "/", null, null, true); // httponly !!!

                        return "Хм, что-то не получилось";
                    } else {
                        mysqli_close($link);
                        if ($userdata['is_superuser'] == '1') {
                            $_SESSION['is_superuser'] = true;
                        }
                    }
                }
            } else {
                mysqli_close($link);
                return "Вы ввели неправильный логин/пароль";
            }
        } else {
            return 'Вы ввели неправильный логин/пароль';
        }
    }

    public function get_data_reg($post)
    {
        $link = $this->db();
        $err = [];

        if (!preg_match("/^[a-zA-Z0-9]+$/", $post['login']))
            $err[] = "Логин может состоять только из букв английского алфавита и цифр";


        if (strlen($post['login']) < 3 or strlen($post['login']) > 30)
            $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";


        $query = mysqli_query($link, "SELECT user_id FROM users WHERE user_login='" . mysqli_real_escape_string($link, $post['login']) . "'");
        if (mysqli_num_rows($query) > 0)
            $err[] = "Пользователь с таким логином уже существует в базе данных";


        if (count($err) == 0) {

            $login = $post['login'];

            $password = md5(md5(trim($post['password'])));

            mysqli_query($link, "INSERT INTO users SET user_login='" . $login . "', user_password='" . $password . "'") or die("Ошибка " . mysqli_error($link));
            mysqli_close($link);
            return 'success';
        } else {
            mysqli_close($link);
            return $err;
        }
    }

    public function get_data_id($id)
    {
        $link = $this->db();
        $query = mysqli_query($link, "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '" . intval($id) . "' LIMIT 1");
        mysqli_close($link);
        return mysqli_fetch_assoc($query);
    }

    public function get_add($post)
    {
        $link = $this->db();
        if ($post['super'] == 'on') {
            $query = "INSERT INTO users SET user_login='" . $post['login'] . "', user_password='" . md5(md5($post['password'])) . "', is_superuser = '1'";
        } else {
            $query = "INSERT INTO users SET user_login='" . $post['login'] . "', user_password='" . md5(md5($post['password'])) . "'";
        }
        mysqli_query($link, $query) or die($query . mysqli_error($link));
        mysqli_close($link);
    }

    public function get_edit($post)
    {
        $link = $this->db();
        $userdata = $this->get_current_user($post['ID']);
        if ($userdata['user_password'] == $_POST['password']) {
            if ($post['super'] == 'on')
                $query = "UPDATE users SET user_login = '" . $post['login'] . "', is_superuser = '1' WHERE user_id = " . $post['ID'];
            else
                $query = "UPDATE users SET user_login = '" . $post['login'] . "' WHERE user_id = " . $post['ID'];
        } else {
            if ($post['super'] == 'on')
                $query = "UPDATE users SET user_login = '" . $post['login'] . "', user_password = '" . md5(md5($post['password'])) . "', is_superuser = '1' WHERE user_id = " . $post['ID'];
            else
                $query = "UPDATE users SET user_login = '" . $post['login'] . "', user_password = '" . md5(md5($post['password'])) . "' WHERE user_id = " . $post['ID'];
        }
        mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
    }

    public function get_delete($post)
    {
        $link = $this->db();
        $query = "DELETE FROM users WHERE user_id = " . $post['delID'];
        mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
    }
}