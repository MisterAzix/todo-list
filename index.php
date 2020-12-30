<?php
$title = 'Home';
require_once './Class/Todo.php';
require_once './functions/auth.php';
if (!is_connected()) {
    header('Location: ./login/index.php');
}
$todo = new Todo();
?>

<?php require './elements/header.php'; ?>

<h1>Here your ToDo List!</h1>
<h2><a href="./logout/index.php">Disconnect</a></h2>

<div class="todo-container">
    <form action="" method="post" class="todo-form-container">
        <div class="todo-form-subcontainer">
            <input type="text" name="task" placeholder="Eat some bread!" required>
            <button type="submit">Add</button>
        </div>
    </form>

    <div class="todo-list-container">
        <?php
        for ($i = 0; $i <= 5; $i++) :
            echo $todo->displayTodo('Oui', false);
        endfor;
        ?>
    </div>
</div>

<?php require './elements/footer.php'; ?>