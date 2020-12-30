<div class="todo">
    <div class="todo-title">
        <?= $todoTitle ?: 'Eat some bread' ?>
    </div>
    <div class="todo-status">
        <i>
            <?php if ($todoStatus): ?>
                <img src="../assets/img/icon_check_mark.svg" alt="">
            <?php endif ?>
        </i>
    </div>
    <div class="todo-delete">
        <img src="../assets/img/icon_trash.svg" alt="">
    </div>
</div>