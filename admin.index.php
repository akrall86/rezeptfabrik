<?php
require_once 'inc/maininclude.php';
require_once 'inc/logininclude.php';
require_once 'inc/admin.indexinclude.php';
require_once 'inc/requireadmin.php';
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
            <h2>Benutzer Übersicht</h2>
            <form action="admin.index.php" method="POST">
                <button name="btgetusers">Alle Benutzer Anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Rezepte</h2>
            <form action="admin.index.php" method="POST">
                <button name="getrecipes">Alle Rezepte anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Zutaten</h2>
            <form action="admin.index.php" method="POST">
                <button name="getingredients">Alle Zutaten anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Maßeinheiten</h2>
            <form action="admin.index.php" method="POST">
                <button name="getunitofmeasurement">Alle Maßeinheiten anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Typen</h2>
            <form action="admin.index.php" method="POST">
                <button name="gettypes">Alle Typen anzeigen</button>
            </form>
        </div>
        <div>
            <h2>Kategorien</h2>
            <form action="admin.index.php" method="POST">
                <button name="getcategories">Alle Rezepte anzeigen</button>
            </form>
        </div>
        <?php
        if (isset($_POST['getrecipes'])) {
            $recipes = $recipeManager->getAllRecipes();
            if (count($recipes) == 0) {
                echo '<p> Noch keine Rezepte vorhanden. </p>';
            } else {
                echo " <table class='admin_table'>
                    <tr>
                        <th>Titel</th>
                        <th>Kategorie</th>
                        <th>Typ</th>
                        <th>erstellt von</th>
                        <th>erstellt am</th>
                    </tr>";
            }
            foreach ($recipes as $recipe) {
                $recipe_id = $recipe->getId();
                echo "  <tr>
                        <td>" . $recipe->getTitle() . "</td>
                        <td>" . $recipe->getCategory()->getName() . "</td>
                        <td>" . $recipe->getType()->getName() . "</td>
                        <td>" . $recipe->getUser()->getUserName() . "</td>
                        <td>" . $recipe->getPublishedDate()->format('d.m.Y H:i:s') . "</td>
                        <td><a href='recipe.delete.php?id=$recipe_id'>Löschen</a> </td>
                   </tr>";
            }
            echo "</table>";
        }
        if (isset($_POST['getingredients'])) {
            $ingredients = $ingredientManager->getIngredients();
            if (count($ingredients) == 0) {
                echo '<p> Noch keine Zutaten vorhanden. </p>';
            } else {
                echo " <table class='admin_table'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>";
            }
            foreach ($ingredients as $ingredient) {
                $ingredient_id = $ingredient->getId();
                echo "  <tr>
                        <td>" . $ingredient->getId() . "</td>
                        <td>" . $ingredient->getName() . "</td>
                        <td><a href='admin.index.php?id=$ingredient_id'>Bearbeiten</a> </td>
                   </tr>";
            }
            echo "</table>";
        }
        if (isset($_POST['getunitofmeasurement'])) {
            $unitofmeasurements = $measuringUnitManager->getMeasuringUnits();
            if (count($unitofmeasurements) == 0) {
                echo '<p> Noch keine Maßeinheiten vorhanden. </p>';
            } else {
                echo " <table class='admin_table'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>";
            }
            foreach ($unitofmeasurements as $unitofmeasurement) {
                $unitofmeasurement_id = $unitofmeasurement->getId();
                echo "  <tr>
                       <td>" . $unitofmeasurement->getId() . "</td>
                        <td>" . $unitofmeasurement->getName() . "</td>
                        <td><a href='recipe.delete.php?id=$unitofmeasurement_id'>Bearbeiten</a> </td>
                   </tr>";
            }
            echo "</table>";
        }
        if (isset($_POST['gettypes'])) {
            $types = $typeManager->getTypes();
            if (count($types) == 0) {
                echo '<p> Noch keine Typen vorhanden. </p>';
            } else {
                echo " <table class='admin_table'>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>";
            }
            foreach ($types as $type) {
                $type_id = $type->getId();
                echo "  <tr>
                        <td>" . $type->getId() . "</td>
                        <td>" . $type->getName() . "</td>
                        <td><a href='recipe.delete.php?id=$type_id'>Bearbeiten</a> </td>
                   </tr>";
            }
            echo "</table>";
        }
        if (isset($_POST['getcategories'])) {
            $categories = $categoryManager->getCategories();
            if (count($categories) == 0) {
                echo '<p> Noch keine Kategorien vorhanden. </p>';
            } else {
                echo " <table class='admin_table'>
                  <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>";
            }
            foreach ($categories as $category) {
                $category_id = $category->getId();
                echo "  <tr>
                        <td>" . $category->getId() . "</td>
                        <td>" . $category->getName() . "</td>
                        <td><a href='recipe.delete.php?id=$category_id'>Bearbeiten</a> </td>
                   </tr>";
            }
            echo "</table>";
        }
        ?>
    </div>

    <?php
    include "inc/footer.php";
    ?>
</div>

</body>
</html>
