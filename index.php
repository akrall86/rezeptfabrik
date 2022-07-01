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
        <h1>Rezepte des Tages</h1>
        <?php
        $breakfast = $recipeManager->getOneRandomRecipeByCategory("Frühstück");
        if ($breakfast) {
            $recipeManager->displayShortVersionOfRecipe($breakfast);
            echo "<br/><br/>";
        }

        $starter = $recipeManager->getOneRandomRecipeByCategory("Vorspeise");
        if ($starter) {
            $recipeManager->displayShortVersionOfRecipe($starter);
            echo "<br/><br/>";
        }

        $dinner = $recipeManager->getOneRandomRecipeByCategory("Hauptspeise");
        if ($dinner) {
            $recipeManager->displayShortVersionOfRecipe($dinner);
            echo "<br/><br/>";
        }

        $dessert = $recipeManager->getOneRandomRecipeByCategory("Dessert");
        if ($dessert) {
            $recipeManager->displayShortVersionOfRecipe($dessert);
            echo "<br/><br/>";
        }

        $drink = $recipeManager->getOneRandomRecipeByCategory("Getränk");
        if ($drink) {
            $recipeManager->displayShortVersionOfRecipe($drink);
            echo "<br/><br/>";
        }
        ?>

    </div>

    <?php
    include "inc/footer.php";
    ?>
</div>

</body>
</html>
