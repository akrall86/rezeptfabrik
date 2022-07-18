<?php
if (isset($_POST['btlogin'])) {
    if (strlen(trim($_POST['email'])) == 0) {
        $errors['email'] = 'E-Mail eingeben.';
    }
    if (strlen(trim($_POST['password'])) == 0) {
        $errors['password'] = 'Passwort eingebn';
    }
    if (count($errors) == 0) {
        $user = $userManager->login($_POST['email'], $_POST['password']);
        if ($user !== false) {
            header("Location: ./?loggedin=true");
            return;
        } else {
            $errors['login'] = 'Login fehlgeschlagen.';
        }
    }

}