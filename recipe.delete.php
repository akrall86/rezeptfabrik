<?php
require_once 'inc/maininclude.php';
require_once 'manager/measuringunitmanager.php';
require_once 'manager/recipeingredientmanager.php';
require_once 'manager/categorymanager.php';
require_once 'manager/typemanager.php';
require_once 'manager/recipemanager.php';

$recipe_id = $_GET['id'];
$recipe = $recipeManager->getRecipe($recipe_id);

if (isset($_POST['delete'])) {
    $recipeManager->deleteRecipe($recipe);
    header('Location: ./admin.index.php');
}
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
        <h1>Rezept löschen</h1>
        <br/>
        <h2> <?php echo $recipe->getTitle(); ?> </h2>
        <br/>
        <form>
            <p>Willst du dieses Rezept wirklich löschen?</p>
            <div>
                <button name="delete">Rezept löschen</button>
            </div>
        </form>
    </div>
    <?php
    include "inc/footer.php";
    ?>
</div>


</body>
</html>


