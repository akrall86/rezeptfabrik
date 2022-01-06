<?php
if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] != null) {
    $user = $userManager->getUserById($_SESSION['user_id']);
    if ($user === false) {
        sleep(5);
        $errors[] = 'User nicht gefunden.';
        header("Location: ./profile.php");
        return;
    }
}

if (isset($_POST['btupdate']) && $_POST['password']) {

    require_once __DIR__ . './registerupdateerrormessages.inc.php';
    if (strlen(trim($_POST['newpassword'])) != 0) {
        if (strlen(trim($_POST['newpassword'])) < 6) {
            $errors['newpassword'] = 'neues Passwort muss mindestens 6 Zeichen haben.';
        }
        if (strlen(trim($_POST['newpasswordrepeat'])) != strlen(trim($_POST['newpassword']))) {
            $errors['newpasswordrepeat'] = 'neues Passwort stimmt nicht überein.';
        }
        if (strcmp($_POST['password'], $_POST['passwordrepeat']) !== 0) {
            $errors['passwordrepeat'] = 'Passwörter stimmen nicht überein.';
        }
    }
    if (!password_verify($_POST['password'], $user->password)) {
        $errors['password'] = 'Passwort stimmt nicht überein';
    }

    if (count($errors) == 0) {
        if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] != 0) {
            $user->firstname = $_POST['firstname'];
            $user->lastname = $_POST['lastname'];
            $user->user_name = $_POST['user_name'];
            $user->email = $_POST['email'];
            if (strlen(trim($_POST['newpassword'])) != 0 && strlen(trim($_POST['newpasswordrepeat'])) === strlen(trim($_POST['newpassword']))) {
                $user->password = $_POST['newpassword'];
            } else {
                $user->password = $_POST['password'];
            }
            $userManager->updateUser($user);
            header("Location: ./profile.php");
            return;
        }
    }
}