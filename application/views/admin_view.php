<h1>Админка</h1>
<br>
<h3 id="portfolio">Портфолио</h3>
<table class="table table-bordered w-auto">
    <tr>
        <th scope="col">Год</th>
        <th scope="col">Проект</th>
        <th scope="col">Описание</th>
        <th scope="col">Сохранить изменения</th>
        <th scope="col">Удалить</th>
    </tr>
    <?php
    $portfolio = $data['portfolio'];
    foreach ($portfolio as $row) : ?>
        <tr>
            <form action="/admin/edit_port/" method="post">
                <input type="hidden" name="ID" value="<?= $row['id'] ?>">
                <td>
                    <input name="year" type="number" min="1990" max="2022"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $row['Year'] ?>">
                </td>
                <td>
                    <input name="site"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $row['Site'] ?>">
                </td>
                <td>
                    <input name="description"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $row['Description'] ?>">
                </td>
                <td class="text-center">
                    <button class="btn btn-white" type="submit"><i class="bi bi-pencil"></i></button>
                </td>
            </form>
            <form action="/admin/delete_port/" method="post">
                <td class="text-center align-middle">
                    <input type="hidden" name="delID" value="<?= $row['id'] ?>">
                    <button class="btn btn-close" type="submit"></button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>

    <form action="/admin/add_port/" method="post">
        <!--        <input type="hidden" name="delID" value="' . $row['id'] . '">-->
        <td>
            <input name="year" required type="number" min="1990" max="2022"
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
            <input name="site" required
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
            <input name="description" required
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td class="text-center">
            <button class="btn btn-white" type="submit">Добавить</button>
        </td>
        <td class="text-center align-middle">
            <button class="btn btn-close" disabled></button>
        </td>
    </form>
</table>

<br>
<h3 id="news">Новости</h3>
<table class="table table-bordered w-auto">
    <tr>
        <th scope="col">Титл</th>
        <th scope="col">Описание</th>
        <th scope="col">Изображение</th>
        <th scope="col">Сохранить изменения</th>
        <th scope="col">Удалить</th>
        <th scope="col">Комментарии</th>

    </tr>
    <?php
    $news = $data['news'];
    foreach ($news as $row) : ?>
        <tr>
            <form action="/admin/edit_news/" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="<?= $row['id'] ?>">
                <td>
                    <input name="title"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $row['title'] ?>">
                </td>
                <td>
                    <input name="body"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $row['body'] ?>">
                </td>
                <td>
                    <input name="image" type="file" accept=".jpg, .jpeg, .png"
                           class="form-control form-control-plaintext w-auto">
                </td>
                <td class="text-center">
                    <button class="btn btn-white" type="submit"><i class="bi bi-pencil"></i></button>
                </td>
            </form>
            <form action="/admin/delete_news/" method="post">
                <td class="text-center align-middle">
                    <input type="hidden" name="delID" value="<?= $row['id'] ?>">
                    <button class="btn btn-close" type="submit"></button>
                </td>
            </form>
            <td class="p-0">
                <ul class="list-group">
                    <?php foreach ($row['comments'] as $comm): ?>
                        <li class="list-group-item p-1">
                            <?= $comm['body'] ?>
                            <div class="fw-bold"><?= $comm['creator'] ?></div>
                            <form action="/admin/delete_comment" method="post">
                                <input type="hidden" name="commID" value="<?= $comm['id'] ?>">
                                <button class="btn btn-close" type="submit"></button>
                            </form>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </td>
        </tr>
    <?php endforeach ?>
    <form action="/admin/add_news/" method="post" enctype="multipart/form-data">
        <!--        <input type="hidden" name="delID" value="' . $row['id'] . '">-->
        <td>
            <input name="title" required
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
            <input name="body" required
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
            <input name="image" type="file" accept=".jpg, .jpeg, .png"
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td class="text-center">
            <button class="btn btn-white" type="submit">Добавить</button>
        </td>
        <td class="text-center align-middle">
            <button class="btn btn-close" disabled></button>
        </td>
        <td>

        </td>


    </form>
</table>

<br>
<h3 id="users">Пользователи</h3>
<table class="table table-bordered w-auto">
    <!--    Все проекты в следующей таблице являются вымышленными, поэтому даже не пытайтесь перейти по приведенным ссылкам.-->
    <tr>
        <th scope="col">id</th>
        <th scope="col">login</th>
        <th scope="col">password</th>
        <th scope="col">superuser</th>
        <th scope="col">Сохранить изменения</th>
        <th scope="col">Удалить</th>
    </tr>
    <?php
    $users = $data['users'];
    foreach ($users as $row) :?>
        <tr>
            <form action="/admin/edit_user/" method="post">
                <input type="hidden" name="ID" value="<?= $row['id'] ?>">
                <td><?= $row['id'] ?></td>
                <td>
                    <input name="login"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $row['login'] ?>">
                </td>
                <td>
                    <input name="password"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $row['password'] ?>">
                </td>
                <td>
                    <input type="checkbox" name="super" <?php if ($row['is_superuser'] == '1'): ?>checked<?php endif; ?>
                           class="form-check-input">
                </td>
                <td class="text-center">
                    <button class="btn btn-white" type="submit"><i class="bi bi-pencil"></i></button>
                </td>
            </form>
            <form action="/admin/delete_user/" method="post">
                <td class="text-center align-middle">
                    <input type="hidden" name="delID" value="<?= $row['id'] ?>">
                    <button class="btn btn-close" type="submit"></button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
    <form action="/admin/add_user/" method="post">
        <td>
            new
        </td>
        <td>
            <input name="login" required
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
            <input name="password" required
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
            <input type="checkbox" name="super"
                   class="form-check-input">
        </td>
        <td class="text-center">
            <button class="btn btn-white" type="submit">Добавить</button>
        </td>
        <td class="text-center align-middle">
            <button class="btn btn-close" disabled></button>
        </td>
    </form>
</table>

<br>
<h3 id="services">Услуги</h3>
<table class="table table-bordered w-auto">
    <tr>
        <th scope="col">Название</th>
        <th scope="col">Описание</th>
        <th scope="col">Изображение</th>
        <th scope="col">Кто записался</th>
        <th scope="col">Сохранить изменения</th>
        <th scope="col">Удалить</th>
    </tr>
    <?php $services = $data['services'];
    foreach ($services as $item) :?>
        <tr>
            <form action="/admin/edit_services/" method="post" enctype="multipart/form-data">
                <input type="hidden" name="ID" value="<?= $item['id'] ?>">
                <td>
                    <input name="title"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $item['title'] ?>">
                </td>
                <td>
                    <input name="body"
                           class="form-control form-control-plaintext w-auto"
                           value="<?= $item['body'] ?>">
                </td>
                <td>
                    <input name="image" type="file" accept=".jpg, .jpeg, .png"
                           class="form-control form-control-plaintext w-auto">
                </td>
                <td class="p-0">
                    <ul class="list-group">
                        <?php foreach ($item['enrolled'] as $enrolled): ?>
                            <li class="list-group-item p-1">
                                <?= $enrolled['user']['user_login'] ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
                <td class="text-center">
                    <button class="btn btn-white" type="submit"><i class="bi bi-pencil"></i></button>
                </td>
            </form>
            <form action="/admin/delete_services/" method="post">
                <td class="text-center align-middle">
                    <input type="hidden" name="delID" value="<?= $item['id'] ?>">
                    <button class="btn btn-close" type="submit"></button>
                </td>
            </form>
        </tr>
    <?php endforeach; ?>
    <form action="/admin/add_services/" method="post" enctype="multipart/form-data">
        <!--        <input type="hidden" name="delID" value="' . $row['id'] . '">-->
        <td>
            <input name="title" required
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
            <input name="body" required
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
            <input name="image" type="file" accept=".jpg, .jpeg, .png"
                   class="form-control form-control-plaintext w-auto">
        </td>
        <td>
        </td>
        <td class="text-center">
            <button class="btn btn-white" type="submit">Добавить</button>
        </td>
        <td class="text-center align-middle">
            <button class="btn btn-close" disabled></button>
        </td>
    </form>
</table>
