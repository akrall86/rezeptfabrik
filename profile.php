<?php
require_once 'inc/maininclude.inc.php';
require_once 'inc/requirelogin.inc.php';
require_once 'inc/profileinclude.inc.php';
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
    <!-- header -->
    <header>
        <?php
        include "inc/header.inc.php";
        include "inc/navbar.inc.php";
        ?>
    </header>

    <!-- content -->
    <div class="content">
        <div>
            <h2>Persönliche Daten</h2>
            <?php include 'inc/errormessages.inc.php' ?>
            Vorname: <?php echo $user->firstname ?><br/>
            Nachname: <?php echo $user->lastname ?><br/>
            Benutzername: <?php echo $user->user_name ?><br/>
            E-Mail: <?php echo $user->email ?><br/><br/>
            <form action="profile.php" method="POST">
                <button name="btsubmit">Daten Bearbeiten</button>
            </form>

        </div>
        <div>
            <h2>Meine Rezepte</h2>
            <li><a href="./recipe.update.form.php">Rezept bearbeiten</a></li>
        </div>
        <div>
            <h2>Meine Favoriten</h2>
        </div>
    </div>

    <!-- footer -->
    <?php include 'inc/footer.inc.php'; ?>

</div>
</body>
</html>