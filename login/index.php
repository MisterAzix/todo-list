<?php
$title = 'Login';
$error = null;
$email = 'flizi@live.fr';
$password = '$2y$12$kSNS4r0M86kzEzMvjFm3XOqkzUDijt3W7Ftd4jz8Hbafv2yUWQJHW';

if(!empty($_POST['email']) && !empty($_POST['password'])) {
    if($_POST['email'] === $email && password_verify($_POST['password'], $password)) {
        session_start();
        $_SESSION['logged'] = 1;
        header('Location: ../index.php');
        exit();
    }else {
        $error = 'Error : Invalid password or email!';
    }
}

require_once '../functions/auth.php';
if(is_connected()) {
    header('Location: ../index.php');
}

require '../elements/header.php';
?>

<h1>Welcome, please log in to access your ToDo list !</h1>

<?php if($error): ?>
    <h2><?= $error ?></h2>
<?php endif ?>

<form action="" method="post" class="form-container">
    <div class="form-subcontainer">
        <label for="email">Email Address *</label>
        <input type="email" name="email" placeholder="contact@example.com" required>
    </div>
    <div class="form-subcontainer">
        <label for="password">Password *</label>
        <input type="password" name="password" placeholder="••••••••••••••••••••" required>
    </div>
    <div class="form-submit-container">
        <input type="submit" value="Log in">
    </div>
</form>

<?php require '../elements/footer.php'; ?>