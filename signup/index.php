<?php
$title = 'Login';
$error = null;

if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
    if (strlen($_POST['username']) <= 5) {
        $error = 'Error : Username length must be longer than 5 characters!';
    } else if (strlen($_POST['password']) <= 8) {
        $error = 'Error : Password length must be longer than 8 characters!';
    } else {
        require_once '../Class/Auth.php';
        $auth = new Auth();
        $login = $auth->signup($_POST['username'], $_POST['email'], $_POST['password']);
        if ($login) {
            header('Location: ../login/index.php');
            exit();
        } else {
            $error = 'Error : Username or email already been used!';
        }
    }
    unset($_POST['username'], $_POST['email'], $_POST['password']);
}

require '../elements/header.php';
?>

<h1>You don't have any account? Just signup right now!</h1>

<?php if ($error) : ?>
    <h2><?= $error ?></h2>
<?php endif ?>

<form action="" method="post" class="form-container">
    <div class="form-subcontainer">
        <label for="username">Username *</label>
        <input type="text" name="username" placeholder="SuperUsername" required>
    </div>
    <div class="form-subcontainer">
        <label for="email">Email Address *</label>
        <input type="email" name="email" placeholder="contact@example.com" required>
    </div>
    <div class="form-subcontainer">
        <label for="password">Password *</label>
        <input type="password" name="password" placeholder="••••••••••••••••••••" required>
    </div>
    <div class="form-submit-container">
        <button type="submit">Sign Up</button>
    </div>
</form>

<?php require '../elements/footer.php'; ?>