<?php
if (isset($_POST['name'])) {
    require_once('../Class/Todo.php');
    $todo = new Todo();
    $key = substr($_POST['name'], 5);
    $todoStatus = $todo->switchTodoStatus($key);
}else {
    header('500 Internal Server Error', true, 500);
    die('Error was detected!');
}