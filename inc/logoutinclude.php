<?php
if (isset($_POST['btlogout'])) {
    $userManager->logout();
    header('Location: ./');
    return;
}