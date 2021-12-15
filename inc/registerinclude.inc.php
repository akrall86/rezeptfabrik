<?php
if (isset($_POST['btregister'])) {
   require_once __DIR__ . './registerupdateerrormessages.inc.php';
    if (strlen(trim($_POST['password'])) < 6) {
        $errors['password'] = 'Passwort muss mindestens 6 Zeichen haben.';
    }
    if (strlen(trim($_POST['passwordrepeat'])) != strlen(trim($_POST['password']))) {
        $errors['passwordrepeat'] = 'Passwörter stimmen nicht überein.';
    }
    if (count($errors) == 0) {
        $userId = $userManager->createUser($_POST['firstname'], $_POST['lastname'], $_POST['user_name'], $_POST['email'], $_POST['password']);
        header("Location: ./login.php?registered=true&userid=$userId");
        return;
    }
}