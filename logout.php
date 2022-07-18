<?php
require_once 'inc/maininclude.php';
require_once 'inc/logoutinclude.php';
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
    <header>
        <!-- header -->
        <?php
        include 'inc/header.php';
        include "inc/navbar.php";
        ?>

        <!-- content -->
    </header>

    <div class="content">
        <h1>Logout</h1>
        <form action="logout.php" method="POST">
            <div>
                <button name="btlogout">Logout</button>
            </div>
        </form>
    </div>


    <!-- footer -->
    <?php include 'inc/footer.php'; ?>
</div>

</body>
</html>
