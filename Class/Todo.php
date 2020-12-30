<?php
class Todo
{
    private $file;

    public function __construct()
    {
        $this->file = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . '_data' . DIRECTORY_SEPARATOR . 'todos.json';
    }

    public function displayTodo()
    {
        $json = $this->readTodo();
        
        foreach ($json as $data) {
            //var_dump($data);
            $todoTitle = $data['title'];
            $todoStatus = $data['status'];
            require './functions/todo.php';
        }
    }

    public function writeTodo(string $title, bool $status = false)
    {
        $json = $this->readTodo();
        $jsonLength = count($json);
        $json[$jsonLength+1] = array("title" => $title, "status" => $status);
        file_put_contents($this->file, json_encode($json));
    }

    public function readTodo(int $todoNumber = 0, int $limit = 0)
    {
        return json_decode(file_get_contents($this->file), true);
    }
}
