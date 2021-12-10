<?php
require_once 'inc/maininclude.inc.php';
require_once 'db/dbtoolkit.php';
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
        $recipeManager->displayRecipe($breakfast);
        ?>
        </br>
        <h1>Rezept des Tages</h1>
        <p>Vorspeise:</p>
        <?php
        $starter = $recipeManager->getOneRandomRecipeByCategory("Vorspeise");
        $recipeManager->displayRecipe($starter);
        ?>
        <p>Hauptspeise:</p>
        <?php
        $dinner = $recipeManager->getOneRandomRecipeByCategory("Hauptspeise");
        $recipeManager->displayRecipe($dinner);
        ?>
        <p>Nachspeise:</p>
        <?php
        $dessert = $recipeManager->getOneRandomRecipeByCategory("Nachspeise");
        $recipeManager->displayRecipe($dessert);
        ?>
        </br>
        <h1>Getränk des Tages</h1>
        <?php
        $drink = $recipeManager->getOneRandomRecipeByCategory("Getränk");
        $recipeManager->displayRecipe($drink);
        ?>
    </div>

    <?php
    include "inc/footer.inc.php";
    ?>
</div>

</body>
</html>
