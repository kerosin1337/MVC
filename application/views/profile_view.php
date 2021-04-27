<h2 class="">Профиль</h2>
<form method="post" action="/profile/edit/">
    <input type="hidden" name="ID" value="<?=$data['user_id']?>">
    <div class="mb-3">
        <label for="exampleInputLogin1" class="form-label">Логин</label>
        <input type="text" class="form-control" id="exampleInputLogin1" name="login" value="<?=$data['user_login']?>">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?=$data['user_password']?>">
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Обновить">
</form>