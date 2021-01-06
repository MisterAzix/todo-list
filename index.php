<?php
$title = 'Home';
$profilePicture = '../assets/img/base_profile_picture.png';
require_once './Class/Todo.php';
require_once './Class/Auth.php';
require_once './Class/User.php';

$user = new User();
$userData = $user->getUserData();
if ($userData->profile_path && file_exists($userData->profile_path)) {
    $profilePicture = $userData->profile_path;
}

$auth = new Auth();
if (!$auth->is_connected()) {
    header('Location: ./login/index.php');
}

$todo = new Todo();
$error = null;
if (isset($_POST['todo'])) {
    if (strlen($_POST['todo']) > 10) {
        $succes = $todo->writeTodo($_POST['todo']);
        if (!$succes) {
            $error = 'Todo already exist!';
        }
    } else {
        $error = 'Todo title length must be longer than 10 characters!';
    }
    //header('Location: ./index.php');
}

require './elements/header.php';
?>

<h1>Here your ToDo List!</h1>

<?php if ($error) : ?>
    <h3><?= $error ?></h3>
<?php endif ?>

<div class="profile-container">
    <img class="profile-picture" src="<?= $profilePicture ?>" alt="Profile Picture">
    <div class="profile-settings-container" style="display: none;">
        <a href="./setting/index.php"><img src="./assets/img/icon_settings.svg" alt="Settings Button"></a>
        <a href="./logout/index.php"><img src="./assets/img/icon_logout.svg" alt="Logout Button"></a>
    </div>
</div>

<div class="todo-container">
    <form action="" method="POST" class="todo-form-container">
        <div class="todo-form-subcontainer">
            <input id="todo" type="text" name="todo" placeholder="Eat some bread!" required>
            <button type="submit">Add</button>
        </div>
    </form>

    <div class="todo-list-container">
        <?php $todo->displayTodo() ?>
    </div>
</div>

<?php require './elements/footer.php'; ?>