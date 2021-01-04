<?php
if (!isset($_POST['name'])) {
    header('500 Internal Server Error', true, 500);
    die('Error was detected!');
} else {
    require_once('../Class/Todo.php');
    $todo = new Todo();
    $key = substr($_POST['name'], 5);
    $todo->switchTodoStatus($key);
}
