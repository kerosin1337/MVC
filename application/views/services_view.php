<h2 id="" class="pl-3 pr-3">Услуги</h2>
<div class="card-columns">
    <?php foreach ($data as $item) : ?>
        <div class="card m-3 shadow-lg bg-white rounded" style="width: 16rem">
            <?php if (isset($item['image'])) : ?>
                <img src="images/<?= $item['image'] ?>" alt="..." class="card-img-top">
            <?php endif; ?>
            <div class="card-body p-1">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['title'] ?></h5>
                    <p class="card-text"><?= $item['body'] ?></p>
<!--                    $item['enrolled'][]['user']['user_login']-->
                    <?php if (isset($_SESSION['id']) && isset($_SESSION['hash'])) : ?>
                        <form action="/services/choice" method="post">
                            <input type="hidden" name="servID" value="<?= $item['id'] ?>">
                            <button type="submit" class="btn btn-primary">Выбрать</button>
                        </form>
                    <?php else: ?>
                        <span class="text-muted">Авторизуйтесь, чтобы записаться.</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
