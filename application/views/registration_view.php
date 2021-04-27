<h2 class="">Регистрация</h2>
<?php if (isset($data)): ?>
    <?php foreach ($data as $err): ?>
        <div class="alert alert-danger" role="alert">
            <?= $err ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
<form method="POST" action="/auth/registration/">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Логин</label>
        <input type="text" class="form-control" name="login">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" name="password">
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Зарегитрироваться">
</form>
