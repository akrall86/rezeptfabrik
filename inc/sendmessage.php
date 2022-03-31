<?php
require_once 'inc/maininclude.php';
require_once 'inc/errormessages.php';

if (isset($_POST['submit'])) {
    $to_user = $_POST['to_user'];
    $from_user_id = (int)$_SESSION['user_id'];

    if (strlen(trim($_POST['message'])) == 0) {
        $errors['message'] = 'Nachricht eingeben.';
    }
    else {
        $messageManager->sendMessage($from_user_id, $to_user, $_POST['message']);
        header("Location: ./message.view.php?registered=true");
    }
}

?>

