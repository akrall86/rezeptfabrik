<?php
if (isset($_POST['btregister'])) {
    if (strlen(trim($_POST['firstname'])) == 0) {
        $errors['firstname'] = 'Vorname eingeben.';
    }

    if (strlen(trim($_POST['lastname'])) == 0) {
        $errors['lastname'] = 'Nachnamen eingeben.';
    }
    if (strlen(trim($_POST['user_name'])) < 4) {
        $errors['user_name'] = 'Benutzername muss mindestens 4 Zeichen haben.';
    }
    if (strlen(trim($_POST['email'])) < 5 || strpos($_POST['email'], '@') == false) {
        $errors['emails'] = 'E-Mail eingeben.';
    }
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