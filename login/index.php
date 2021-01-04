<?php
$title = 'Login';
$error = null;

require_once '../Class/Auth.php';
$auth = new Auth();

if($auth->is_connected()) {
    header('Location: ../index.php');
}

if(!empty($_POST['email']) && !empty($_POST['password'])) {
    $login = $auth->login($_POST['email'], $_POST['password']);
    if($login) {
        header('Location: ../index.php');
        exit();
    }else {
        $error = 'Error : Invalid password or email!';
    }
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