<?php
include 'inc/errormessages.inc.php';
include 'manager/measuringunitmanager.inc.php';

$measurementUnits = $measuringUnitManager->getMeasuringUnits();
?>


!DOCTYPE HTML>
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
        <h1>Neues Rezept erstellen</h1>
        <form enctype="multipart/form-data" action="./recipe.create.php" method="post">
            <?php include 'inc/errormessages.inc.php'; ?>
            <div>
                <div>
                    <label for="title">Titel:</label><br/>
                    <input type="text" name="title" id="title">
                </div>

                <div>
                    <label for="category">Kategorie:</label><br/>
                    <select name="category" id="category">
                        <?php
                        foreach ($categories as $category) {
                            $name = $category->getName()
                            ?>
                            <option value='<?php $name ?>'><?php echo $name ?></option>";
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="type">Typ:</label><br/>
                    <select name="type" id="type">
                        <?php
                        foreach ($types as $type) {
                            $name = $type->getName()
                            ?>
                            <option value='<?php $name ?>'><?php echo $name ?></option>";
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <?php
                    if (isset ($_SESSION['recipe_ingredients'])) {
                        $recipe_ingredients = $_SESSION['recipe_ingredients'];
                        foreach ($recipe_ingredients as $recipe_ingredient) {
                            echo $recipe_ingredient->getAmount() . " " .
                                $recipe_ingredient->getUnitOfMeasurementName() . " " .
                                $recipe_ingredient->getIngredientName() . "<br/><br/>";
                        }
                    }
                    ?>
                    <label for="ingredient">Zutat:</label>
                    <label class="input_measure" for="measure">Menge:</label><br/>
                    <input class="input_ingredients" type="text" name="ingredient" id="ingredient">
                    <input class="input_ingredients" type="text" name="measure" id="measure">
                    <select class="select_unit_of_measurement" name="measurementUnit" id="measurementUnit">
                        <?php
                        foreach ($measurementUnits as $measurementUnit) {
                            $name = $measurementUnit->getName()
                            ?>
                            <option value='<?php $name ?>'><?php echo $name ?></option>";
                            <?php
                        }
                        ?>
                    </select>
                    <button name="add_ingredient">hinzufügen</button>
                    <?php if (isset($_POST['add_ingredient'])) {
                        $recipe_Ingredient [] = $_POST['ingredient'];
                    } ?>
                </div>
                <div>
                    <label for="description">Beschreibung:</label><br/>
                    <textarea class="description" type="text" name="description" id="description"></textarea>
                </div>
                <div>
                    <label for="picture">Bild:</label><br>
                    <input class="file_upload" type="file" name="picture" id="picture" accept="image/jpeg, image/png" ">
                </div>
                <br/>
                <div>
                    <button name="submit">Speichern</button>
                </div>
        </form>

    </div>

</div>
<?php
include "inc/footer.inc.php";
?>

</body>
</html>