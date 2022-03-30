<?php
require_once 'inc/maininclude.php';

require_once 'manager/usermanager.php';
require_once 'inc/errormessages.php';


$from_user_id = (int)$_SESSION['user_id'];
$to_user = $_GET['id'];


if (isset($_POST['submit'])) {
    if (strlen(trim($_POST['message'])) == 0) {
        $errors['message'] = 'Nachricht eingeben.';
    }
    else {
        $messagemanger->sendMessage($from_user_id, $to_user, $_POST['message']);
    }

}



?>

