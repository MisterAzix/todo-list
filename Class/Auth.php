<?php

class Auth
{
    public $file;

    public function __construct()
    {
        $this->file = dirname(__FILE__, 2) . DIRECTORY_SEPARATOR . '_data' . DIRECTORY_SEPARATOR . 'todos.db';
    }

    public function is_connected(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return !empty($_SESSION['logged']);
    }

    public function get_connected_id()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return $_SESSION['logged'];
    }

    public function signup(string $username, string $email, string $password): bool
    {
        $pdo = new PDO('sqlite:' . $this->file);
        try {
            $query = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $query->execute([
                'username' => $username,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT, [ 'cost' => 12])
            ]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function login(string $email, string $password): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $pdo = new PDO('sqlite:' . $this->file);
        $query = $pdo->prepare("SELECT id, password FROM users WHERE email=:email");
        $query->execute([
            'email' => $email
        ]);
        $result = $query->fetch(PDO::FETCH_OBJ);
        if ($result) {
            if (password_verify($password, $result->password)) {
                $_SESSION['logged'] = $result->id;
                return true;
            }
        }
        return false;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['logged']);
    }
}
