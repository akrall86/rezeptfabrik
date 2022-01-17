<?php
require_once 'inc/maininclude.php';
require_once 'inc/logininclude.php';
require_once 'inc/admin.indexinclude.php';
require_once 'inc/requireadmin.php';
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

        <div>
            <h2>Benutzer Übersicht</h2>
            <form action="admin.index.php" method="POST">
                <button name="btgetusers">Alle Benutzer Anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Rezepte Übersicht</h2>
            <form action="admin.index.php" method="POST">
                <button name="submit">Alle Rezepte anzeigen</button>
            </form>
        </div>
        <?php
        if (isset($_POST['submit'])) {
        $recipes = $recipeManager->getAllRecipes();
        if (count($recipes) == 0) {
            echo '<p> Noch keine Rezepte vorhanden. </p>';
        } else {
            echo " <table>
                    <tr>
                        <th class='admin_table'>Titel</th>
                        <th class='admin_table'>Kategorie</th>
                        <th class='admin_table'>Typ</th>
                        <th class='admin_table'>erstellt von</th>
                        <th class='admin_table'>erstellt am</th>
                    </tr>";
        }
        foreach ($recipes as $recipe) {
            $recipe_id = $recipe->getId();
            echo "  <tr>
                        <td>".$recipe->getTitle()."</td>
                        <td>".$recipe->getCategory()->getName()."</td>
                        <td>".$recipe->getType()->getName()."</td>
                        <td>".$recipe->getUser()->getUserName()."</td>
                        <td>".$recipe->getPublishedDate()->format('d.m.Y H:i:s') ."</td>
                        <td><a href='admin.recipe.php?id=$recipe_id'>Bearbeiten</a> </td>
                   </tr>";
        }
        echo "</table>";
        }
        ?>
    </div>

    <?php
    include "inc/footer.php";
    ?>
</div>

</body>
</html>
