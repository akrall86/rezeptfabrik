<?php
if (strlen(trim($_POST['firstname'])) == 0) {
    $errors['firstname'] = 'Vorname eingeben.';
}

if (strlen(trim($_POST['lastname'])) == 0) {
    $errors['lastname'] = 'Nachnamen eingeben.';
}
if (strlen(trim($_POST['user_name'])) < 4) {
    $errors['user_name'] = 'Benutzername muss mindestens 4 Zeichen haben.';
}
if (strlen(trim($_POST['email'])) < 5 && strpos($_POST['email'], '@') == false) {
    $errors['emails'] = 'E-Mail eingeben.';
}