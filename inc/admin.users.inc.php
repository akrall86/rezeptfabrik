<?php

if (isset($_POST['btedit'])) {
    header("Location: ./admin.user.php?id=".$user_id);
    return;
}