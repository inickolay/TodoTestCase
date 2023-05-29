<form method="post" action="/task/create" class="row mb-5">
    <div class="col-md-3"><input class="form-control" name="name" placeholder="Name" required></div>
    <div class="col-md-3"><input class="form-control" type="email" name="email" placeholder="Email" required></div>
    <div class="col-md-5"><input class="form-control" name="text" placeholder="Text" required></div>
    <div class="col-md-1"><button class="btn btn-primary">Add</button></div>
</form>


<div class="row text-center">
    <div class="col-md-3 mb-2">
        <a href="/<?= addGetVariable(['sort' => 'name', 'order' => 'ASC']) ?>">&downarrow;</a>
        <a href="/<?= addGetVariable(['sort' => 'name', 'order' => 'DESC']) ?>">&uparrow;</a>
    </div>
    <div class="col-md-3 mb-2">
        <a href="/<?= addGetVariable(['sort' => 'email', 'order' => 'ASC']) ?>">&downarrow;</a>
        <a href="/<?= addGetVariable(['sort' => 'email', 'order' => 'DESC']) ?>">&uparrow;</a>
    </div>
    <div class="col-md-5 mb-2">
        <a href="/<?= addGetVariable(['sort' => 'text', 'order' => 'ASC']) ?>">&downarrow;</a>
        <a href="/<?= addGetVariable(['sort' => 'text', 'order' => 'DESC']) ?>">&uparrow;</a>
    </div>
</div>

<?php foreach ($tasks as $task) : ?>
    <form method="post" action="/task/update?id=<?= $task['id'] ?>" class="row align-items-center mb-3">
        <div class="col-md-1 text-center">
            <input type="checkbox" name="is_done" <?= 0 === $task['is_done'] ?: 'checked' ?> <?= (\Todo\Session::isAuth() ?: 'disabled') ?>>
        </div>
        <div class="col-md-3">
            <input class="form-control" name="name" placeholder="Name" value="<?= $task['name'] ?>" <?= (\Todo\Session::isAuth() ?: 'disabled') ?>>
        </div>
        <div class="col-md-3">
            <input class="form-control" name="email" placeholder="Email" value="<?= $task['email'] ?>" <?= (\Todo\Session::isAuth() ?: 'disabled') ?>>
        </div>
        <div class="col-md-4">
            <input class="form-control" name="text" placeholder="Text" value="<?= $task['text'] ?>" <?= (\Todo\Session::isAuth() ?: 'disabled') ?>>
        </div>
        <?php if (\Todo\Session::isAuth()) : ?>
        <div class="col-md-1">
            <button class="btn btn-primary">Update</button>
        </div>
        <?php endif ?>
    </form>
<?php endforeach ?>

<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center mt-5">
        <?php for ($i = 1; $i < $total / $perPage; $i++) : ?>
        <li class="page-item <?= ($i === $page) ? 'active' : '' ?>"><a class="page-link" href="/<?= addGetVariable(['page' => $i]) ?>"><?= $i ?></a></li>
        <?php endfor ?>
    </ul>
</nav>