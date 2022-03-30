<?php
if (!$userManager->isLoggedIn()) {
    header('Location: ./login.form.php');
    return;
}