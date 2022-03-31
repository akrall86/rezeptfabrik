<?php
if (!$userManager->isLoggedIn()) {
    header('Location: ./login.php');
    return;
}