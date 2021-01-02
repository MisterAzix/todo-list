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
        krsort($json);

        foreach ($json as $key => $data) {
            $todoTitle = $data['title'];
            $todoStatus = $data['status'];
            require './functions/todo.php';
        }
    }

    public function switchTodoStatus(int $todoID): bool
    {
        $json = $this->readTodo();
        $newStatus = $json[$todoID]["status"] ? false : true;
        $json[$todoID] = array("title" => $json[$todoID]['title'], "status" => $newStatus);
        file_put_contents($this->file, json_encode($json));
        return $newStatus;
    }

    public function writeTodo(string $title, bool $status = false): bool
    {
        $json = $this->readTodo();
        if (!$this->todoExist($title, $json)) {
            $jsonLength = count($json);
            $json[$jsonLength + 1] = array("title" => $title, "status" => $status);
            file_put_contents($this->file, json_encode($json));
            return true;
        } else {
            return false;
        }
    }

    private function readTodo(int $todoNumber = 0, int $limit = 0)
    {
        return json_decode(file_get_contents($this->file), true);
    }

    private function todoExist(string $title, $json = null): bool
    {
        $json = $json ?: $this->readTodo();
        foreach ($json as $data) {
            if ($data['title'] == $title) {
                return true;
            }
        }
        return false;
    }
}
