<?php

if (isset($_POST['btgetusers'])) {
    $user_id= $_POST['user_id'];
    header("Location: ./admin.user.php=id=".$user_id);
    return;
}