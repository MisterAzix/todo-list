<?php
$title = 'Home';
$profilePicture = '../assets/img/base_profile_picture.png';
require_once './Class/Todo.php';
require_once './Class/Auth.php';
require_once './Class/User.php';

$auth = new Auth();
if (!$auth->is_connected()) {
    header('Location: ./login');
}

$user = new User();
$userData = $user->getUserData();
if ($userData->profile_path && file_exists('./_data/_img/' . $userData->profile_path)) {
    $profilePicture = './_data/_img/' . $userData->profile_path;
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

$todoCounter = $todo->getTodoCount();
?>

<h1>Here your ToDo List!</h1>

<?php if ($error) : ?>
    <h3><?= $error ?></h3>
<?php endif ?>

<div class="profile-container">
    <img class="profile-picture" src="<?= $profilePicture ?>" alt="Profile Picture">
    <div class="profile-settings-container" style="display: none;">
        <a href="./setting"><img src="./assets/img/icon_settings.svg" alt="Settings Button"></a>
        <a href="./logout"><img src="./assets/img/icon_logout.svg" alt="Logout Button"></a>
    </div>
</div>

<span id="todo-counter" data-counter=<?= $todoCounter?:'0'?>>0/100</span>

<div class="todo-container">
    <form action="" method="POST" class="todo-form-container">
        <div class="todo-form-subcontainer">
            <input id="todo" type="text" name="todo" placeholder="Eat some bread!" required>
            <button id="todo-add" type="submit">Add</button>
        </div>
    </form>

    <ul class="filter-nav">
        <li><button id="filter-all">All</button></li>
        <li><button id="filter-todo" class="active">Todo</button></li>
        <!-- <li><button id="filter-priority">Priority</button></li>
        <li><button id="filter-important">Important</button></li> -->
        <li><button id="filter-finished">Finished</button></li>
    </ul>

    <div class="todo-list-container">
        <?php $todo->displayTodo() ?>
    </div>
</div>

<?php require './elements/footer.php'; ?>