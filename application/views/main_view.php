<h2 id="" class="pl-3 pr-3">Новости</h2>

<?php foreach ($data as $item) : ?>

    <div class="mb-3">
        <div class="card m-0 shadow-lg bg-white rounded">
            <?php if (isset($item['image'])) : ?>
                <img src="images/<?= $item['image'] ?>" alt="...">
            <?php endif; ?>
            <div class="card-body">
                <div class="card-body">
                    <h5 class="card-title"><?= $item['title'] ?></h5>
                    <p class="card-text"><?= $item['body'] ?></p>
                    <p class="card-text"><small class="text-muted">Пользователь: <?= $item['creator'] ?></small></p>
                </div>
            </div>
            <div class="accordion" id="accordion<?= $item['id'] ?>">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $item['id'] ?>">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse<?= $item['id'] ?>" aria-expanded="false"
                                aria-controls="collapse<?= $item['id'] ?>">
                            Комментарии <span class="badge bg-primary"><?= sizeof($item['comments']) ?></span>
                        </button>

                    </h2>
                    <div id="collapse<?= $item['id'] ?>" class="accordion-collapse collapse"
                         aria-labelledby="heading<?= $item['id'] ?>" data-bs-parent="#accordion<?= $item['id'] ?>">
                        <?php foreach ($item['comments'] as $comm) : ?>
                            <div class="accordion-body border">
                                <div class="d-flex">
                                    <?= $comm['body'] ?>
<!--                                    --><?php //if (isset($_SESSION['id'])): ?>
                                        <?php if (isset($_SESSION['id']) and $comm['user_id'] == $_SESSION['id']): ?>
                                            <form action="/main/delete_comment/" method="post"
                                                  class="d-flex ms-auto">
                                                <input type="hidden" name="commID" value="<?= $comm['id'] ?>">
                                                <button class="btn btn-close" type="submit"></button>
                                            </form>
                                        <?php endif; ?>
<!--                                    --><?php //endif; ?>
                                </div>

                                <div>
                                    <span class="text-muted">Пользователь: <?= $comm['creator'] ?>
                                    </span>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php if (isset($_SESSION['id']) && isset($_SESSION['hash'])): ?>
                            <form action="/main/add_comment/" method="post">
                                <input type="hidden" name="new_id" value="<?= $item['id'] ?>">
                                <div class="input-group">
                                    <input type="text" name="comment" class="form-control" id="inputGroupFile04"
                                           placeholder="Комментарий" aria-describedby="inputGroupFileAddon04"
                                           required>
                                    <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04">
                                        Отправить
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

