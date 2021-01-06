<?php
class Todo
{
    private $file;
    private $auth;

    public function __construct()
    {
        require_once 'Auth.php';
        $this->file = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . '_data' . DIRECTORY_SEPARATOR . 'todos.db';
        $this->auth = new Auth();
    }

    public function displayTodo()
    {
        $todos = $this->readTodo();

        foreach ($todos as $todo) {
            $key = $todo->id;
            $todoTitle = $todo->title;
            $todoStatus = $todo->status;
            $time = $todo->created_at;
            require './elements/todo.php';
        }
    }

    public function switchTodoStatus(int $todoID)
    {
        $pdo = new PDO('sqlite:' . $this->file);
        $query = $pdo->prepare("UPDATE todos SET status=(CASE WHEN status=0 THEN 1 WHEN status=1 THEN 0 END) WHERE id=:id");
        $query->execute([
            'id' => $todoID
        ]);
    }

    public function writeTodo(string $title): bool
    {
        if (!$this->todoExist($title)) {
            $userID = $this->auth->get_connected_id();
            $pdo = new PDO('sqlite:' . $this->file);
            $query = $pdo->prepare("INSERT INTO todos (user_id, title, created_at) VALUES (:user_id, :title, :created)");
            $query->execute([
                'user_id' => $userID,
                'title' => $title,
                'created' => time()
            ]);
            return true;
        } else {
            return false;
        }
    }

    public function deleteTodo(int $todoID)
    {
        $pdo = new PDO('sqlite:' . $this->file);
        $query = $pdo->prepare("DELETE FROM todos WHERE id=:id");
        $query->execute([
            'id' => $todoID
        ]);
    }

    private function readTodo(int $limit = 0)
    {
        $userID = $this->auth->get_connected_id();
        $pdo = new PDO('sqlite:' . $this->file);
        $query = ($limit > 0) ? $pdo->query("SELECT * FROM todos WHERE user_id=$userID LIMIT=$limit ORDER BY id DESC") : $pdo->query("SELECT * FROM todos WHERE user_id=$userID ORDER BY id DESC");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    private function todoExist(string $title): bool
    {
        $userID = $this->auth->get_connected_id();
        $pdo = new PDO('sqlite:' . $this->file);
        $query = $pdo->prepare("SELECT * FROM todos WHERE user_id=:user_id AND title=:title");
        $query->execute([
            ':user_id' => $userID,
            'title' => $title
        ]);
        return $query->fetchAll(PDO::FETCH_OBJ) ? true : false;
    }
}
