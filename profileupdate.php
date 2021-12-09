<?php
require_once 'inc/maininclude.inc.php';

if (isset($_SESSION['loggedin']) && $_SESSION['user_id'] != null) {
    $user = $userManager->getUserById($_SESSION['user_id']);
    if ($user === false) {
        $errors[] = 'User nicht gefunden.';
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
    <div id="content">
        <form action="profileupdate.php" method="POST">
            <?php include 'inc/errormessages.inc.php' ?>
            <div>
                <label for="firstname">Vorname:</label>
                <input type="text" name="firstname" id="firstname" value="<?php echo $user->getFirstname() ?>">
            </div>
            <div>
                <label for="lastname">Nachname:</label>
                <input type="text" name="lastname" id="lastname" value="<?php echo $user->getLastname() ?>">
            </div>
            <div>
                <label for="user_name">Benutzername:</label>
                <input type="text" name="user_name" id="user_name" value="<?php echo $user->getUserName() ?>">
            </div>
            <div>
                <label for="email">E-Mail:</label>
                <input type="email" name="email" id="email" value="<?php echo $user->getEmail() ?>">
            </div>
            <div>
                <button name="btupdate">Daten aktualisieren</button>
            </div>
        </form>
    </div>
</main>

<!-- footer -->
<?php include 'inc/footer.inc.php'; ?>

</body>
</html>