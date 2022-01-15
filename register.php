<?php
require_once 'inc/maininclude.php';
require_once 'inc/registerinclude.php';
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
        <?php include 'inc/header.php';
        include "inc/navbar.php";
        ?>
    </header>
    <!-- content -->
    <div class="content">
        <h1>Registrierung</h1>
        <form name="register" action="register.php" method="POST">
            <?php include 'inc/errormessages.php' ?>
            <div>
                <label for="firstname">Vorname:</label>
                <input type="text" name="firstname" id="firstname"
                       value="<?php if ($_REQUEST != null && $_REQUEST['firstname'] != null) echo $_REQUEST['firstname'] ?>">
            </div>
            <div>
                <label for="lastname">Nachname:</label>
                <input type="text" name="lastname" id="lastname"
                       value="<?php if ($_REQUEST != null && $_REQUEST['lastname'] != null) echo $_REQUEST['lastname'] ?>">
            </div>
            <div>
                <label for="user_name">Benutzername:</label>
                <input type="text" name="user_name" id="user_name"
                       value="<?php if ($_REQUEST != null && $_REQUEST['user_name'] != null) echo $_REQUEST['user_name'] ?>">
            </div>
            <div>
                <label for="email">E-Mail:</label>
                <input type="email" name="email" id="email"
                       value="<?php if ($_REQUEST != null && $_REQUEST['email'] != null) echo $_REQUEST['email'] ?>">
            </div>
            <div>
                <label for="password">Passwort:</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <label for="passwordrepeat">Passwort wiederholen:</label>
                <input type="password" name="passwordrepeat" id="passwordrepeat">
            </div>
            <br/>
            <div>
                <button name="btregister">Registrieren</button>
            </div>
        </form>
    </div>


    <!-- footer -->
    <?php include 'inc/footer.php'; ?>
</div>

</body>
</html>
