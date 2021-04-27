<h2 class="">Авторизация</h2>
<form method="post" action="/auth/login/">
    <?php if (isset($data)):?>
    <div class="alert alert-danger" role="alert">
        <?= $data ?>
    </div>
    <?php endif;?>
    <div class="mb-3">
        <label for="exampleInputLogin1" class="form-label">Логин</label>
        <input type="text" class="form-control" id="exampleInputLogin1" name="login">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" id="exampleCheck1" class="form-check-input" name="not_attach_ip">
        <label class="form-check-label" for="exampleCheck1">Не прикреплять к IP(не безопасно)</label>
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Авторизоваться">
</form>