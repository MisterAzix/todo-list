<?php
$title = 'Logout';
require_once '../Class/Auth.php';
$auth = new Auth();
$auth->logout();
header('Location: ../login');