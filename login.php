<?php
require_once 'inc/maininclude.inc.php';

if (isset($_POST['btlogin'])) {
    if (strlen(trim($_POST['email'])) == 0 || strlen($_POST['email'], '@') == false) {
        $errors['email'] = 'E-Mail eingeben.';
    }
    if (strlen(trim($_POST['password'])) == 0) {
        $errors['password'] = 'Passwort eingebn';
    }

}
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
<main class="center-wrapper">
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
            <button name="btlogin">Login</button>
        </div>
</main>

<!-- footer -->
<?php include 'inc/footer.inc.php'; ?>

</body>
</html>
