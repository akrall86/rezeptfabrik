<?php
require_once 'inc/maininclude.php';
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
        <?php
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <div class="content">
        <h1>Rezepte-Liste</h1>
        <a href="admin.index.php">Zurück</a>
        <br/><br/>
        <?php
        $recipes = $recipeManager->getAllRecipes();
        if (count($recipes) == 0) {
            echo '<p> Noch keine Rezepte vorhanden. </p>';
        } else {
            echo " <table class='admin_table'>
                    <tr>
                        <th>Titel</th>
                        <th>Kategorie</th>
                        <th>Typ</th>
                        <th>erstellt von</th>
                        <th>erstellt am</th>
                    </tr>";
        }
        foreach ($recipes as $recipe) {
            $recipe_id = $recipe->getId();
            echo "  <tr>
                        <td class='admin_table'> " . $recipe->getTitle() . " </td>
                        <td class='admin_table'> " . $recipe->getCategory()->getName() . " </td>
                        <td class='admin_table'> " . $recipe->getType()->getName() . " </td>
                        <td class='admin_table'> " . $recipe->getUser()->getUserName() . " </td>
                        <td class='admin_table'> " . $recipe->getPublishedDate()->format('d.m.Y H:i:s') . " </td>
                        <td class='admin_table'><a href='recipe.delete.php?id=$recipe_id'>Löschen</a> </td>
                   </tr>";
        }
        echo "</table>
    </div>";
        include "inc/footer.php";
        ?>

    </div>
</body>
</html>
