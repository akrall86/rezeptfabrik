<?php
require_once 'inc/maininclude.php';
require_once 'inc/logininclude.php';
require_once 'inc/admin.indexinclude.php';
require_once 'inc/requireadmin.php';
require_once 'inc/admin.recipemanagement.php';
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
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <div class="content">

        <div>
            <h2>Benutzer Übersicht</h2>
            <form action="admin.index.php" method="POST">
                <button name="btgetusers">Alle Benutzer Anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Rezepte</h2>
            <form action="admin.index.php" method="POST">
                <button name="getrecipes">Alle Rezepte anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Maßeinheiten</h2>
            <form action="admin.index.php" method="POST">
                <button name="getunitofmeasurement">Alle Maßeinheiten anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Typen</h2>
            <form action="admin.index.php" method="POST">
                <button name="gettypes">Alle Typen anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Kategorien</h2>
            <form action="admin.index.php" method="POST">
                <button name="getcategories">Alle Kategorien anzeigen</button>
            </form>
        </div>
        <?php
        include "inc/admin.recipemanagement.php";
        ?>
    </div>

    <?php
    include "inc/footer.php";
    ?>
</div>

</body>
</html>
