<?php

class User
{
    private $file;
    private $auth;

    public function __construct()
    {
        require_once 'Auth.php';
        $this->file = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . '_data' . DIRECTORY_SEPARATOR . 'todos.db';
        $this->auth = new Auth();
    }

    public function getUserData()
    {
        $userID = $this->auth->get_connected_id();
        $pdo = new PDO('sqlite:' . $this->file);
        $query = $pdo->query("SELECT * FROM users WHERE id=$userID");
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
