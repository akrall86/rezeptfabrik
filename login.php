<?php
require_once 'inc/maininclude.php';
require_once 'inc/logininclude.php';
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

        <h1>Login</h1>
        <form action="login.php" method="POST">
            <?php include 'inc/errormessages.php' ?>
            <div>
                <label for="email">E-Mail:</label>
                <input name="email" id="email">
            </div>
            <div>
                <label for="password">Passwort:</label>
                <input type="password" name="password" id="password">
            </div>
            <br/>
            <div>
                <button name="btlogin">Login</button>
            </div>
        </form>
    </div>

    <!-- footer -->
    <?php include 'inc/footer.php'; ?>
</div>

</body>
</html>
