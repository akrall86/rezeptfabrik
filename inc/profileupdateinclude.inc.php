<?php
if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] != null) {
    $user = $userManager->getUserById($_SESSION['user_id']);
    if ($user === false) {
        sleep(5);
        $errors[] = 'User nicht gefunden.';
        header("Location: ./profile.php");
    }

}