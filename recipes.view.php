<?php
require_once 'inc/maininclude.php';
require_once 'manager/measuringunitmanager.php';
require_once 'manager/recipeingredientmanager.php';
require_once 'manager/categorymanager.php';

$categories = $categoryManager->getCategories();
$types = $typeManager->getTypes();
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

        <h1>Rezepte</h1>
        <form class="filter_recipe" action="recipes.view.php" method="post">
            <div>
                <label for="category">Filtern nach Kategorie:</label><br>
                <select name="category" id="category">
                    <?php
                    foreach ($categories as $category) {
                        $name = $category->getName()
                        ?>
                        <option value='<?php echo $name ?>'><?php echo $name ?></option>";
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <button name="filterCategory">filtern</button>
            </div>
        </form>
        <form class="filter_recipe" action="recipes.view.php" method="post">
            <div>
                <label for="type">Filtern nach Typ:</label><br>
                <select name="type" id="type">
                    <?php
                    foreach ($types as $type) {
                        $name = $type->getName()
                        ?>
                        <option value='<?php echo $name ?>'><?php echo $name ?></option>";
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <button name="filterType">filtern</button>
            </div>
        </form>
        <br/>


        <?php
        if (isset($_POST['filterCategory'])) {
            $recipesByCategory = $recipeManager->getRecipesByCategory($_POST['category']);
            $recipes_per_page = 5;
            $page_number = ((isset($_GET["pagecount"])) ? $_GET["pagecount"] : 0);
            $number = 0;
            for ($count = 0; $count < count($recipesByCategory); $count += $recipes_per_page) {
                $number++;
                echo '<a href="?pagecount=' . $count . '">' .
                    (($count == $page_number) ? "[" . $number . "]" : $number) . ' </a>';
            }
            for ($count = $page_number; $count < ($page_number + $recipes_per_page); $count++) {
                if (isset($recipesByCategory[$count])) {
                    echo "<p>" . $recipeManager->displayShortVersionOfRecipe($recipesByCategory[$count]) . "</p>\n";
                }
            }
        } elseif (isset($_POST['filterType'])) {
            $recipes = $recipeManager->getRecipesByType($_POST['type']);

            $recipes_per_page = 5;
            $page_number = ((isset($_GET["pagecount"])) ? $_GET["pagecount"] : 0);
            $number = 0;
            for ($count = 0; $count < count($recipes); $count += $recipes_per_page) {
                $number++;
                echo '<a href="?pagecount=' . $count . '">' .
                    (($count == $page_number) ? "[" . $number . "]" : $number) . ' </a>';
            }
            for ($count = $page_number; $count < ($page_number + $recipes_per_page); $count++) {
                if (isset($recipes[$count])) {
                    echo "<p>" . $recipeManager->displayShortVersionOfRecipe($recipes[$count]) . "</p>\n";
                }
            }
        } else {
            $recipes = $recipeManager->getAllRecipes();
            $recipes_per_page = 5;
            $page_number = ((isset($_GET["pagecount"])) ? $_GET["pagecount"] : 0);
            $number = 0;
            for ($count = 0; $count < count($recipes); $count += $recipes_per_page) {
                $number++;
                echo '<a href="?pagecount=' . $count . '">' .
                    (($count == $page_number) ? "[" . $number . "]" : $number) . ' </a>';
            }
            echo"<br/>";

            for ($count = $page_number; $count < ($page_number + $recipes_per_page); $count++) {
                if (isset($recipes[$count])) {
                    echo "<p>" . $recipeManager->displayShortVersionOfRecipe($recipes[$count]) . "</p>\n";
                }
            }
        }
        ?>

    </div>
    <?php
    include "inc/footer.php";
    ?>
</div>

</body>
</html>

