<?php
require_once 'inc/maininclude.php';
require_once 'inc/logininclude.php';
require_once 'inc/requireadmin.php';
$users = $userManager->getUsers();
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
    <header>
        <?php
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <div class="content">
        <h1>Typen</h1>
        <a href="admin.index.php">Zurück</a>
        <br/><br/>
        <?php
        $categories = $categoryManager->getCategories();
        if (count($categories) == 0) {
            echo '<p> Noch keine Kategorien vorhanden. </p>';
        } else {
            echo " <table class='admin_table'>
                  <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>";
        }
        foreach ($categories as $category) {
            $category_id = $category->getId();
            echo "  <tr>
                        <td> " . $category->getId() . " </td>
                        <td> " . $category->getName() . " </td>
                   </tr>";
        }
        echo "</table>
        <form action='admin.categories.php' method='POST'>
                <?php include 'inc/errormessages.php' ?>
        <div>
            <label for='name'>Neue Kategorie hinzufügen:</label>
            <input type='text' name='name' id='name'>
            <button name='add'>hinzufügen</button>
        </div>";
        if (isset($_POST['add'])) {
            $categoryManager->createCategory($_POST['name']);
            header("Location: ./admin.categories.php");
        }
        echo "</div>";
        include "inc/footer.php";
        ?>

    </div>
</body>
</html>
