<?php

class Todo
{
    public function displayTodo(string $title, bool $status)
    {
        $todoTitle = $title;
        $todoStatus = $status;
        require './functions/todo.php';
    }

    public function writeTodo()
    {

    }

    public function readTodo()
    {

    }
}
