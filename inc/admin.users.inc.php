<?php

if (isset($_POST['btedit'])) {
    header("Location: ./admin.user.php?id=".$_POST['user_id']);
    return;
}