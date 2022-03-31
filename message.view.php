<?php
require_once 'inc/maininclude.php';
require_once 'inc/sendmessage.php';

?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <title>rezeptfabrik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/yrzh53e1pluir30xdlmiyrryst09opb6vf7vy441zi3nai5h/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            toolbar: 'undo redo | bold italic underline | numlist bullist',
            plugins: 'lists',
            menubar: ''
        });
    </script>
    <link rel="stylesheet" href="css/style.css"/>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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
        <h1>Deine Nachrichten</h1>

    </div>

    <?php
    include "inc/footer.php";
    ?>
</div>
</body>
</html>


