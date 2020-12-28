<?php
$title = 'Logout';
session_start();
unset($_SESSION['logged']);
header('Location: ../login/index.php');