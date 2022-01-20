<?php
require_once 'inc/maininclude.php';
require_once 'inc/requirelogin.php';
require_once 'inc/profileinclude.php';
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
    <!-- header -->
    <header>
        <?php
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <!-- content -->
    <div class="content">
        <div>
            <h2>Persönliche Daten</h2>
            <?php include 'inc/errormessages.php' ?>
            Vorname: <?php echo $user->firstname ?><br/>
            Nachname: <?php echo $user->lastname ?><br/>
            Benutzername: <?php echo $user->user_name ?><br/>
            E-Mail: <?php echo $user->email ?><br/><br/>
            <form action="profile.php" method="POST">
                <button name="btsubmit">Daten Bearbeiten</button>
            </form>

        </div>
        <div>
            <h2>Meine Rezepte</h2>
            <?php
            $my_recipes = $recipeManager->getRecipesByUser($_SESSION['user_id']);
            foreach ($my_recipes as $recipe) {
                $recipe_id = $recipe->getId();
                $category = $recipe->getCategory();
                $type = $recipe->getType();
                $date = $recipe->getPublishedDate();
                $slug = $recipe->getSlug();
                $recipeManager->displayShortVersionOfRecipe($recipe);
                ?>
                <form action="recipe.update.form.php?<?php echo $slug ?>" method="POST">
                    <input type="hidden" id="recipe_id" name="recipe_id" value="<?php echo $recipe_id ?>">
                    <button name=<?php echo $recipe_id . 'submit' ?>>Rezept bearbeiten</button>
                </form>
                <?php
                if (isset($_POST[$recipe_id . 'submit'])) {
                    header('Location: recipe.update.form.php?' . $slug);
                }
            }
            ?>
        </div>
        <div>
            <h2>Meine Favoriten</h2>
            <?php
            $my_recipes = $recipeManager->getFavoriteRecipes($_SESSION['user_id']);
            foreach ($my_recipes as $recipe) {
                $recipe_id = $recipe->getId();
                $category = $recipe->getCategory();
                $type = $recipe->getType();
                $date = $recipe->getPublishedDate();
                $slug = $recipe->getSlug();
                $recipeManager->displayShortVersionOfRecipe($recipe);
            }
            ?>
        </div>
    </div>

    <!-- footer -->
    <?php include 'inc/footer.php'; ?>

</div>
</body>
</html>