<?php
$title = 'Home';
require_once './Class/Todo.php';
require_once './functions/auth.php';
if (!is_connected()) {
    header('Location: ./login/index.php');
}

$todo = new Todo();
$error = null;
/*if (isset($_POST['todo'])) {
    if(strlen($_POST['todo']) > 10) {
        $todo->writeTodo($_POST['todo']);
    }else {
        $error = 'Todo title length must be longer than 10 characters!';
    }
}*/
?>

<?php require './elements/header.php'; ?>

<h1>Here your ToDo List!</h1>
<h2><a href="./logout/index.php">Disconnect</a></h2>

<?php if($error): ?>
    <h3><?= $error ?></h3>
<?php endif ?>

<div class="todo-container">
    <form action="" method="POST" class="todo-form-container">
        <div class="todo-form-subcontainer">
            <input id="todo" type="text" name="todo" placeholder="Eat some bread!" required>
            <button type="submit">Add</button>
        </div>
    </form>

    <div class="todo-list-container">
        <?php $todo->displayTodo() ?>
    </div>
</div>

<?php require './elements/footer.php'; ?>