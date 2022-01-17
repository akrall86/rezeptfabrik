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
        <a href="admin.index.php">Zurück</a>

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
                        <td>" . $category->getId() . "</td>
                        <td>" . $category->getName() . "</td>
                        <td><a href='recipe.delete.php?id=$category_id'>Bearbeiten</a> </td>
                   </tr>";
        }
        echo "</table>";

        include "inc/footer.php";
        ?>
    </div>
</div>
</body>
</html>
