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

        <h1>Rezepte des Tages</h1>
        <?php
        $breakfast = $recipeManager->getOneRandomRecipeByCategory("Frühstück");
        if ($breakfast === false) {
            echo "noch kein Frühstücksrezept vorhanden.";
        } else {
            $recipeManager->displayRecipe($breakfast);
        }
        ?>
        <br/>
        <?php
        $starter = $recipeManager->getOneRandomRecipeByCategory("Vorspeise");
        if ($starter === false) {
            echo "noch keine Vorspeise vorhanden.";
        } else {
            $recipeManager->displayRecipe($starter);
        }
        $dinner = $recipeManager->getOneRandomRecipeByCategory("Hauptspeise");
        if ($dinner === false) {
            echo "noch keine Hauptspeise vorhanden.";
        } else {
            $recipeManager->displayRecipe($dinner);
        }
        $dessert = $recipeManager->getOneRandomRecipeByCategory("Nachspeise");
        if ($dessert === false) {
            echo "noch kein Dessert vorhanden.";
        } else {
            $recipeManager->displayRecipe($dessert);
        }
        ?>
        <br/>
        <?php
        $drink = $recipeManager->getOneRandomRecipeByCategory("Getränk");
        if ($drink === false) {
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
