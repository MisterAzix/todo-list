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

$error = null;
$fileName = null;
$profilePicture = '../assets/img/base_profile_picture.png';

if (isset($_FILES['profile-picture'])) {
    $maxSize = 3 * 1000 * 1000; //3Mo
    $validExt = array('.jpg', '.jpeg', '.gif', '.png');

    if ($_FILES['profile-picture']['error'] <= 0) {
        $fileSize = $_FILES['profile-picture']['size'];

        if ($fileSize < $maxSize) {
            $fileName = $_FILES['profile-picture']['name'];
            $fileExt = '.' . strtolower(substr(strrchr($fileName, '.'), 1));

            if (in_array($fileExt, $validExt)) {
                $tmpName = $_FILES['profile-picture']['tmp_name'];
                $uniqueName = md5(uniqid(rand(), true));
                $fileName = '../_data/_img' . $uniqueName . $fileExt;
                $result = move_uploaded_file($tmpName, $fileName);

                if ($result) {
                    $oui = $user->savePicturePath($fileName);
                    if($oui) {
                        $error = 'Profile picture was successfuly uploaded!';
                    } else {
                        $error = 'Error during picture path database save!';
                    }
                    
                }
            } else {
                $error = 'File is not an image!';
            }
        } else {
            $error = 'File is too big!';
        }
    } else {
        $error = 'Error during file transfert!';
    }
}

if ($fileName) {
    $profilePicture = $fileName;
} else if ($userData->profile_path && file_exists($userData->profile_path)) {
    $profilePicture = $userData->profile_path;
}

require '../elements/header.php';
?>

<h1>Here your profile, you can edit your settings here!</h1>

<div class="settings-container">
    <img class="profile-picture" src="<?= $profilePicture ?>" alt="Profile Picture">
    <div class="settings-subcontainer">
        <h2><?= $userData->username ?></h2>
        <p>(<?= $userData->email ?>)</p>

        <form action="" method="post" enctype="multipart/form-data">
            <label>Change your profile picture</label>
            <?php if ($error) : ?>
                <span><?= $error ?></span>
            <?php endif ?>
            <div class="box">
                <input type="file" name="profile-picture" id="file" class="inputfile inputfile-2">
                <label for="file"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                        <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />
                    </svg> <span>Choose a file&hellip;</span></label>
            </div>
            <button>Send</button>
        </form>
    </div>
</div>


<?php require '../elements/footer.php'; ?>