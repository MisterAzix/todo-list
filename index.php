<?php
$title = 'Home';
require_once './functions/auth.php';
if(!is_connected()) {
    header('Location: ./login/index.php');
}

?>

<?php require './elements/header.php'; ?>

<h1>Here your ToDo List!</h1>
<h2><a href="./logout/index.php">Disconnect</a></h2>


<?php require './elements/footer.php'; ?>