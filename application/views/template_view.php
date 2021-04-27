<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?=ucwords(substr($content_view, 0,strpos($content_view, '_')));?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <!--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
</head>
<body class="d-flex flex-column min-vh-100">
<header class="container-xxl shadow-lg p-3 mb-5 rounded">
    <nav class="navbar navbar-expand-lg navbar-light p-0">
        <div class="container-fluid">
            <span class="navbar-brand">MVC</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/services">Услуги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/portfolio">Портфолио</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contacts">Контакты</a>
                    </li>
                    <?php if (isset($_SESSION['id']) and isset($_SESSION['hash'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile">Профиль</a>
                        </li>
                        <?php if (isset($_SESSION['is_superuser'])) : ?>
                            <li>
                                <a class="nav-link text-danger" href="/admin">Админка</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <div class="d-flex ms-auto">
                    <?php if (!isset($_SESSION['id']) && !isset($_SESSION['hash'])) : ?>
                        <a class="nav-link btn btn-outline-info m-1" href="/auth/login">Авторизация</a>
                        <a class="nav-link btn btn-outline-warning m-1" href="/auth/registration">Регистрация</a>
                    <?php else: ?>
                        <a class="nav-link btn btn-outline-danger m-1" href="/auth/logout">Выход</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header>

<main class="container-lg shadow-lg p-3 mb-5 rounded">
    <?php include 'application/views/' . $content_view; ?>
</main>
<footer class="footer p-4 bg-dark mt-auto container-xxl shadow-lg ">
    <div class="container">
        <span class="text-muted">Place sticky footer</span>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf"
        crossorigin="anonymous"></script>
</body>
</html>
