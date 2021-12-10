<?php
require_once 'inc/maininclude.inc.php';
if (isset($_POST['btlogout'])) {
    $userManager->logout();
    header('Location: ./');
    return;
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
<main class="body">
    <h1>Logout</h1>
    <form action="logout.php" method="POST">
        <div>
            <button name="btsubmit">Logout</button>
        </div>
</main>

<!-- footer -->
<?php include 'inc/footer.inc.php'; ?>

</body>
</html>
