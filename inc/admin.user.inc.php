<?php
if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] != null && $_SESSION['admin'] == true && isset($_REQUEST['id']) && $_REQUEST['id'] != 0) {
    $user = $userManager->getUserById($_REQUEST['id']);
    if ($user === false) {
        $errors[] = 'Benutzer nicht gefunden';
    }
    if (isset($_POST['btgetroles']) && $user !== false) {
        $roles = $userManager->getRoles();
    }
    if  (isset($_POST['btdelete']) && $user !== false) {
       if (!password_verify($_REQUEST['password'], $userManager->getUserById($_SESSION['user_id'])->password)) {
           $errors[] = 'Admin passwort richtig eingeben';
       }
        if (count($errors) == 0) {
            $userManager->deleteUserById($user->id);
            header("Location: ./admin.users.php");
            return;
        }

    }

}