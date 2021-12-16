<?php
require_once 'inc/maininclude.inc.php';
require_once 'inc/requirelogin.inc.php';
?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <title>rezeptfabrik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="body">
    <header>
        <?php
        include "inc/header.inc.php";
        include "inc/navbar.inc.php";
        ?>
    </header>
    <div class="content">

        <p class="confirmation">Die Daten wurden erfolgreich gespeichert!</p>

    </div>
    <?php include 'inc/footer.inc.php'; ?>
</div>
</body>
</html>