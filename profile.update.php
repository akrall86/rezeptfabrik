<?php
require_once 'inc/maininclude.php';
require_once 'inc/requirelogin.php';
require_once 'inc/profileupdateinclude.php';
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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<div class="body">
    <!-- header -->
    <header>
        <?php
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <!-- content -->
    <div class="content">
        <form action="profile.update.php" method="POST">

            <?php include 'inc/errormessages.php' ?>
            <input type="hidden" name="id" value="<?php echo $user->id ?>">
            <div>
                <label for="firstname">Vorname:</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $user->firstname ?>">
            </div>
            <div>
                <label for="lastname">Nachname:</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $user->lastname ?>">
            </div>
            <div>
                <label for="user_name">Benutzername:</label>
                <input type="text" name="user_name" id="user_name" value="<?php echo $user->user_name ?>">
            </div>
            <div>
                <label for="email">E-Mail:</label>
                <input type="email" name="email" id="email" value="<?php echo $user->email ?>">
            </div>

            <div>
                <label for="newpassword">Neues Passwort:</label>
                <input type="password" name="newpassword" id="newpassword">
            </div>
            <div>
                <label for="newpasswordrepeat">Neues Passwort wiederholen:</label>
                <input type="password" name="newpasswordrepeat" id="newpasswordrepeat">
            </div>
            <div>
                <label for="password">Mit Passwort Änderung bestätigen:</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <button name="btupdate">Daten aktualisieren</button>
            </div>
        </form>
    </div>

    <!-- footer -->
    <?php include 'inc/footer.php'; ?>
</div>
</body>
</html>