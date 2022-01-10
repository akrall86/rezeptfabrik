<?php
if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] != null && $_SESSION['admin'] == true && isset($_REQUEST['id']) && $_REQUEST['id'] != 0) {
    $user = $userManager->getUserById($_REQUEST['id']);
    if ($user === false) {
        $errors[] = 'Benutzer nicht gefunden';
    }
    if (isset($_POST['btupdate']) && $_POST['password']) {

        require_once __DIR__ . './registerupdateerrormessages.inc.php';
        $newpasswordBool = false;
        $newpassword = "";

        if (strlen(trim($_POST['newpassword'])) != 0) {
            if (strlen(trim($_POST['newpassword'])) < 6) {
                $errors['newpassword'] = 'neues Passwort muss mindestens 6 Zeichen haben';
            }
        }
        if (!password_verify($_POST['password'], $userManager->getUserById($_SESSION['user_id'])->password)) {
            $errors['password'] = 'Admin Passwort stimmt nicht!';
        }
        if ($_POST['password'] == 0) {
            $errors['passwordempty'] = 'Admin Passwort eingeben';
        }
        if (count($errors) == 0) {
            if (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] != 0) {
                if (strlen(trim($_POST['newpassword'])) != 0) {
                    $newpasswordBool = true;
                    $newpassword = $_POST['newpassword'];
                }
                if ($newpasswordBool === false) {
                    $newpassword = $userManager->getUserById($_POST['id'])->password;
                }
                $updateUser = new User($_POST['id'], $_POST['firstname'], $_POST['lastname'], $_POST['user_name'], $_POST['email'], $newpassword);
                if ($newpasswordBool === true) {
                    $userManager->updateUser($updateUser);
                } else {
                    $userManager->updateUserWithOutHash($updateUser);
                }
                header("Location: ./admin.users.php");
                return;
            }
        }
    }

    if (isset($_POST['btgetroles']) && $user !== false) {
        $roles = $userManager->getRoles();
    }

    if (isset($_POST['btupdaterole'])) {
        if (!password_verify($_REQUEST['password'], $userManager->getUserById($_SESSION['user_id'])->password)) {
            $errors[] = 'Admin passwort richtig eingeben';
        }
        $count = $_POST['count'];
        for ($i = 1; $i < $count; $i++) {
            if (isset($_POST['has_role'.$i])) {
                foreach ($userManager->getUserRoles($_POST['id']) as $userRole) {


                }
            }
        }
    }

    if (isset($_POST['btdelete']) && $user !== false) {
        if (!password_verify($_REQUEST['password'], $userManager->getUserById($_SESSION['user_id'])->password)) {
            $errors[] = 'Admin passwort richtig eingeben';
        }

        if (count($errors) == 0) {
            $recipeManager->deleteRecipesFromUser($user->id);
            $userManager->deleteUserById($user->id);
            header("Location: ./admin.users.php");
            return;
        }
    }
}