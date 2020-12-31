<?php
require_once 'console_log.php';
if (isset($_POST['todo-' . $key])) {
    unset($_POST['todo-' . $key]);
    require_once('./Class/Todo.php');
    $todo = new Todo();

    console_log('todo-' . $key);
    $todoStatus = $todo->switchTodoStatus($key);
}
?>

<div class="todo<?= $todoStatus ? ' todo-checked' : '' ?>">
    <div class="todo-title">
        <?= htmlentities($todoTitle ?: 'Eat some bread') ?>
    </div>
    <form action="" method="POST" class="todo-status">
        <button type="submit" name="<?= 'todo-' . $key ?>" <?= $todoStatus ? 'checked' : '' ?>>
            <?php if ($todoStatus) : ?>
                <img src="../assets/img/icon_check_mark.svg" alt="">
            <?php endif ?>
        </button>
    </form>
    <div class="todo-delete">
        <img src="../assets/img/icon_trash.svg" alt="">
    </div>
</div>