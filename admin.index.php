<?php
require_once 'inc/maininclude.inc.php';
require_once 'inc/logininclude.inc.php';
require_once 'inc/requireadmin.inc.php';
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
        <div class="content">
            <div>
                <h2>User Übersicht</h2>
                <form action="admin.index.php" method="POST">
                    <button name="btgetusers">Alle Benutzer Anzeigen</button>
                </form>
            </div>
            <div>
                <h2>Rezepte Übersicht</h2>
            </div>
        </div>

        <?php
        include "inc/footer.inc.php";
        ?>
    </div>

</body>
</html>
