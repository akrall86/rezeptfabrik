<?php
if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] && $_SESSION['admin'] == true) {
    if (isset($_POST['btgetusers'])) {
        header("Location: ./admin.users.php");
        return;
    }
}
