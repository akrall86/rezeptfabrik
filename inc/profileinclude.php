<?php
if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] != null) {
    $user = $userManager->getUserById($_SESSION['user_id']);
    if ($user === false) {
        sleep(5);
        $errors[] = 'User nicht gefunden.';
        header("Location: ./");
        return;
    }
    if (isset($_POST['btsubmit'])) {
        header("Location: ./profile.update.php");
        return;
    }
}
