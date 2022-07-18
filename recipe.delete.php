<?php
require_once 'inc/maininclude.php';
require_once 'manager/measuringunitmanager.php';
require_once 'manager/recipeingredientmanager.php';
require_once 'manager/categorymanager.php';
require_once 'manager/typemanager.php';
require_once 'manager/recipemanager.php';

if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];
    $recipe = $recipeManager->getRecipe($recipe_id);
    $title = $recipe->getTitle();
}
if (!isset($_SESSION['location'])) {
    $location ='Location: ./admin.recipes.php ';
} else {
    $location = 'Location: ' . $_SESSION['location'];
    unset($_SESSION['location']);
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
        <h1>Rezept löschen</h1>
        <br/>
        <h2> <?php echo $title; ?> </h2>
        <br/>
        <form action="" method="post">
            <p>Willst du dieses Rezept wirklich löschen?</p>
            <div>
                <button name="delete">Rezept löschen</button>
            </div>
        </form>
    </div>
    <?php
    if (isset($_POST['delete'])) {
        $recipeManager->deleteRecipe($recipe);
        header($location);
    }
    include "inc/footer.php";
    ?>
</div>

</body>
</html>


