<?php
require_once 'inc/recipe.create.php';
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
        <h1>Neues Rezept erstellen</h1>
        <form enctype="multipart/form-data" action="recipe.create.form.php" method="post">
            <?php include 'inc/errormessages.php' ?>
            <div>
                <label for="title">Titel:</label><br/>
                <input type="text" name="title" id="title"
                       value="<?php if ($_REQUEST != null && $_REQUEST['title'] != null) echo $_REQUEST['title'] ?>">
                <br/>
            </div>
            <div>
                <label for="category">Kategorie:</label><br/>
                <select name="category" id="category">
                    <?php
                    foreach ($categories as $category) {
                        $name = $category->getName();
                        ?>
                        <option value='<?php echo $name ?>'><?php echo $name ?></option>;
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
                        <option value='<?php echo $name ?>'><?php echo $name ?></option>;
                        <?php
                    }

                    ?>
                </select>
                <br/>
            </div>
            <div>
                <?php
                if (isset ($_SESSION['recipe_ingredients'])) {
                    $recipe_ingredients = $_SESSION['recipe_ingredients'];
                    foreach ($recipe_ingredients as $r) {
                        $name = $r->getIngredientName();
                        echo $r->getAmount() . " " .
                            $r->getUnitOfMeasurementName() . " " .
                            $r->getIngredientName() .
                            " <button name=$name>x</button><br/><br/>";

                        if (isset($_POST[$name])) {
                            unset($recipe_ingredients[$r]);
                            header('Location: ./recipe.create.form.php');
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
                       <?php if ($_REQUEST != null && $_REQUEST['description'] != null)
                           echo($_REQUEST['description']) ?>
                    </textarea>
            </div>
            <div>
                <br/>
                <label for="picture">Bild:</label><br>
                <input class="file_upload" type="file" name="picture" id="picture" accept="image/jpeg, image/png">
            </div>
            <br/>
            <div>
                <button name="submit">Speichern</button>
            </div>
        </form>
    </div>
        <?php
        include "inc/footer.php";
        ?>
    </div>
    <?php
    include "inc/footer.inc.php";
    ?>
</div>
</body>
</html>
