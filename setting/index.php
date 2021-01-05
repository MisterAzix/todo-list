<?php
$title = 'Settings';
require_once '../Class/User.php';
require_once '../Class/Auth.php';
$user = new User();
$userData = $user->getUserData();
$auth = new Auth();
if (!$auth->is_connected()) {
    header('Location: ../login/index.php');
}

require '../elements/header.php';
?>

<h1>Here your profile, you can edit your settings here!</h1>

<div class="settings-container">
    <img class="profile-picture" src="../assets/img/profile_picture.jpg" alt="Profile Picture">
    <div class="settings-subcontainer">
        <h2><?= $userData->username ?></h2>
        <p>(<?= $userData->email ?>)</p>
    </div>
</div>


<?php require '../elements/footer.php'; ?>