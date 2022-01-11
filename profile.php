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
                $id = $recipe->getId();
                $category = $recipe->getCategory();
                $type = $recipe->getType();
                $date = $recipe->getPublishedDate();
                echo " <h3>" . $recipe->getTitle() . "</h3> 
                       erstellt am " . $date->format('d.m.Y') . " um " . $date->format('H:i:s') . "<br/>
                       <p>Bewertung: " . $recipe->getRating() . "</p> ";
                ?>
                <form action="profile.php" method="POST">
                    <button name="update">Rezept bearbeiten</button>
                </form>
                <?php
                if (isset($_POST['update'])) {
                    header("Location: ./recipe.update.form.php?id=$id");
                }
            }
            ?>
        </div>
        <div>
            <h2>Meine Favoriten</h2>
        </div>
    </div>

    <!-- footer -->
    <?php include 'inc/footer.php'; ?>

</div>
</body>
</html>