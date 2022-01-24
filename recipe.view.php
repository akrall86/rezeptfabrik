<?php
require_once 'inc/maininclude.php';
require_once 'manager/measuringunitmanager.php';
require_once 'manager/recipeingredientmanager.php';
require_once 'manager/categorymanager.php';

$categories = $categoryManager->getCategories();
$types = $typeManager->getTypes();

$recipe_id = filter_var($_GET["id"]);
$recipe = $recipeManager->getRecipe((int)$recipe_id);
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
            <?php $recipeManager->displayRecipe($recipe); ?>
        </div>
        <div>
            <a href="index.php">zurück</a>
        </div>
        <br/><br/>

    </div>
    <?php
    include "inc/footer.php";
    ?>
</div>

</body>
</html>

