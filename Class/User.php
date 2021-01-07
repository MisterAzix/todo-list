<?php

class User
{
    private $file;
    private $auth;
    private $pdo;

    public function __construct()
    {
        require_once 'Auth.php';
        $this->file = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . '_data' . DIRECTORY_SEPARATOR . 'todos.db';
        $this->auth = new Auth();
        $this->pdo = new PDO('sqlite:' . $this->file);
    }

    public function getUserData()
    {
        $userID = $this->auth->get_connected_id();
        $query = $this->pdo->query("SELECT * FROM users WHERE id=$userID");
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function savePicturePath($picturePath): bool
    {
        $userID = $this->auth->get_connected_id();
        try {
            $query = $this->pdo->prepare("UPDATE users SET profile_path=:path WHERE id=:id");
            $query->execute([
                'path' => $picturePath,
                'id' => $userID
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
