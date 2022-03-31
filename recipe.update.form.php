<?php
require_once 'inc/maininclude.php';
require_once 'manager/measuringunitmanager.php';
require_once 'manager/recipeingredientmanager.php';
require_once 'manager/categorymanager.php';
require_once 'manager/typemanager.php';
require_once 'manager/recipemanager.php';

$recipe_id = $_POST['recipe_id'];
require_once 'inc/recipe.update.php';
?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <title>rezeptfabrik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/yrzh53e1pluir30xdlmiyrryst09opb6vf7vy441zi3nai5h/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            toolbar: 'undo redo | bold italic underline | numlist bullist',
            plugins: 'lists',
            menubar: ''
        });
    </script>
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
        <h1>Rezept bearbeiten</h1>
        <form enctype="multipart/form-data" action="recipe.update.form.php" method="post">
            <?php include 'inc/errormessages.php' ?>
            <div>
                <label for="title">Titel:</label><br/>
                <input type="text" name="title" id="title" value="<?php echo $recipe->getTitle() ?>">
                <br/>
            </div>
            <div>
                <label for="category">Kategorie:</label><br/>
                <select name="category" id="category">
                    <?php
                    $selection = $recipe->getCategory()->getName();
                    foreach ($categories as $category) {
                        $name = $category->getName();
                        $attribute = ($name == $selection) ? ' selected' : '';
                        ?>
                        <option value='<?php echo $name ?>' <?php echo $attribute ?>><?php echo $name ?></option>;
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <label for="type">Typ:</label><br/>
                <select name="type" id="type">
                    <?php
                    $selectedValue = $recipe->getType()->getName();
                    foreach ($types as $type) {
                        $name = $type->getName();
                        $attribute = ($name == $selectedValue) ? ' selected' : '';
                        ?>
                        <option value='<?php echo $name ?>' <?php echo $attribute ?>><?php echo $name ?></option>;
                        <?php
                    }
                    ?>
                </select>
                <br/><br/>
            </div>
            <div>
                <?php
                if (isset ($_SESSION['recipe_ingredients'])) {
                    $recipe_ingredients = $_SESSION['recipe_ingredients'];
                    $count = 0;
                    foreach ($recipe_ingredients as $r) {
                        $name = $r->getIngredientName();
                        if (isset($_POST[$name])) {
                            array_splice($recipe_ingredients, $count, 1);
                            $_SESSION['recipe_ingredients'] = $recipe_ingredients;
                        } else {
                            echo $r->getAmount() . " " .
                                $r->getUnitOfMeasurementName() . " " .
                                $r->getIngredientName() .
                                " <button name=$name>x</button><br/><br/>";
                            $count++;
                        }
                    }
                }
                ?>
            </div>
            <div class="input_ingredients">
                <label for="ingredient">Zutat:</label><br/>
                <input type="text" name="ingredient" id="ingredient">
            </div>
            <div class="input_ingredients">
                <label for="measure">Menge:</label><br/>
                <input class="input_measure" type="text" name="measure" id="measure">
            </div>
            <div class="input_ingredients">
                <label for="measurementUnit">Maßeinheit:</label><br/>
                <select class="select_unit_of_measurement" name="measurementUnit" id="measurementUnit">
                    <?php
                    foreach ($measurementUnits as $measurementUnit) {
                        $name = $measurementUnit->getName()
                        ?>
                        <option value='<?php echo $name ?>'><?php echo $name ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="input_ingredients">
                <button name="add_ingredient">hinzufügen</button>
            </div>
            <div class="description_label">
                <br/>
                <label for="description">Beschreibung:</label><br/>
            </div>
            <div class="description_div">
            <textarea class="description" type="text" name="description" id="description">
                       <?php echo $recipe->getContent() ?></textarea>
                <br/>
            </div>
            <input type="hidden" id="recipe_id" name="recipe_id" value=<?php echo $recipe_id ?>>
            <div>
                <button name="submit">Änderungen speichern</button>
            </div>
            <div>
                <br/><br/>
                <label for="picture">Neues Bild:</label><br>
                <input class="file_upload" type="file" name="picture" id="picture" accept="image/jpeg, image/png">
                <br/>
            </div>
            <input type="hidden" id="recipe_id" name="recipe_id" value=<?php echo $recipe_id ?>>
            <div>
                <button name="image">Neues Bild speichern</button>
            </div>

            <br/>
            <p>Rezept unwiderruflich löschen:</p>
            <input type="hidden" id="recipe_id" name="recipe_id" value=<?php echo $recipe_id ?>>
            <div>
                <button name="delete">Rezept löschen</button>
            </div>

            <br/>

        </form>
    </div>
    <?php
    include "inc/footer.php";
    ?>
</div>


</body>
</html>


