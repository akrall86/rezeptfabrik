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
<div class="body">
    <header>
        <?php
        include "inc/header.inc.php";
        include "inc/navbar.inc.php";
        ?>
    </header>

    <div class="content">

        <h1>Frühstücksrezept des Tages</h1>
        <?php
        $breakfast = $recipeManager->getOneRandomRecipeByCategory("Frühstück");
        if ($breakfast == false) {
            echo "noch kein Frühstücksrezept vorhanden.";
        } else {
            $recipeManager->displayRecipe($breakfast);
        }
        ?>
        </br>
        <h1>Rezept des Tages</h1>
        <p>Vorspeise:</p>
        <?php
        $starter = $recipeManager->getOneRandomRecipeByCategory("Vorspeise");
        if ($starter == false) {
            echo "noch keine Vorspeise vorhanden.";
        } else {
            $recipeManager->displayRecipe($starter);
        }
        ?>
        <p>Hauptspeise:</p>
        <?php
        $dinner = $recipeManager->getOneRandomRecipeByCategory("Hauptspeise");
        if ($dinner == false) {
            echo "noch keine Hauptspeise vorhanden.";
        } else {
            $recipeManager->displayRecipe($dinner);
        }
        ?>
        <p>Nachspeise:</p>
        <?php
        $dessert = $recipeManager->getOneRandomRecipeByCategory("Nachspeise");
        if ($dessert == false) {
            echo "noch kein Dessert vorhanden.";
        } else {
            $recipeManager->displayRecipe($dessert);
        }
        ?>
        </br>
        <h1>Getränk des Tages</h1>
        <?php
        $drink = $recipeManager->getOneRandomRecipeByCategory("Getränk");
        if ($drink == false) {
            echo "noch kein Getränk vorhanden.";
        } else {
            $recipeManager->displayRecipe($drink);
        }
        ?>
    </div>

    <?php
    include "inc/footer.inc.php";
    ?>
</div>

</body>
</html>
