<?php
if (isset($_POST['btregister'])) {
    require_once __DIR__ . './registerupdateerrormessages.php';
    if ($userManager->getUserByEmail($_POST['email'])) {
        $errors['email'] = 'E-mail schon vorhanden!';
    }
    if ($userManager->getUserByUser_Name($_POST['user_name'])) {
        $errors['user_name'] = 'Benutzername schon vorhanden!';
    }
    if (strlen(trim($_POST['password'])) < 6) {
        $errors['password'] = 'Passwort muss mindestens 6 Zeichen haben.';
    }
    if (strcmp($_POST['password'], $_POST['passwordrepeat']) !== 0) {
        $errors['passwordrepeat'] = 'Passwörter stimmen nicht überein.';
    }
    if (count($errors) == 0) {
        $userId = $userManager->createUser($_POST['firstname'], $_POST['lastname'], $_POST['user_name'], $_POST['email'], $_POST['password']);
        header("Location: ./login.php?registered=true");
        return;
    }
}