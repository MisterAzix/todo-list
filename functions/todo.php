<div class="todo<?= $todoStatus ? ' todo-checked' : '' ?>">
    <div class="todo-title">
        <?= htmlentities($todoTitle ?: 'Eat some bread') ?>
    </div>
    <form action="./functions/switchTodoStatus.php" method="POST" class="todo-status">
        <button class="checkbox-button" type="submit" name="<?= 'todo-' . $key ?>">
            <img src="../assets/img/icon_check_mark.svg" alt="" class="<?= $todoStatus ? 'hidden' : '' ?>">
        </button>
    </form>
    <div class="todo-delete">
        <img src="../assets/img/icon_trash.svg" alt="">
    </div>
</div>