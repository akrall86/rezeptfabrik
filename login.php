<?php
require_once 'inc/maininclude.inc.php';
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
<!-- header -->
<?php include 'inc/header.inc.php'; ?>

<!-- content -->
<main class="body">
    <h1>Login</h1>
    <form action="login.php" method="POST">
        <?php include 'inc/errormessages.inc.php' ?>
        <div>
            <label for="email">E-Mail:</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Passwort:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <button name="btsubmit">Login</button>
        </div>
</main>

<!-- footer -->
<?php include 'inc/footer.inc.php'; ?>

</body>
</html>
