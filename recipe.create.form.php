<?php
require_once 'inc/maininclude.inc.php';
require_once 'manager/measuringunitmanager.inc.php';
require_once 'manager/recipeingredientmanager.inc.php';
require_once 'manager/categorymanager.inc.php';
require_once 'model/recipe_ingredient.inc.php';
require_once 'model/type.inc.php';
require_once 'model/category.inc.php';
include 'inc/errormessages.inc.php';

$categories = $categoryManager->getCategories();
$types = $typeManager->getTypes();
$measurementUnits = $measuringUnitManager->getMeasuringUnits();
$count = 0;

// Session for array of Recipe_Ingredients (ingredients, quantities and units of measure)

$recipe_ingredient_array = array();
if (isset ($_SESSION['recipe_ingredients'])) {
    $recipe_ingredient_array = $_SESSION['recipe_ingredients'];
}

// Button add ingredient
if (isset($_POST['add_ingredient'])) {
    if (strlen(trim($_POST['ingredient'])) == 0) {
        $errors['ingredient'] = 'Zutat eingeben.';
    }
    if (strlen(trim($_POST['measure'])) == 0) {
        $errors['measure'] = 'Menge eingeben.';
    }
    if (!is_numeric($_POST['measure'])) {
        $errors['measure'] = 'Menge ist keine Zahl.';
    }
    if (count($errors) == 0) {
        $recipe_ingredient_array [] = new Recipe_Ingredient(
            $_POST['ingredient'], $_POST['measurementUnit'], $_POST['measure']);
        $_SESSION['recipe_ingredients'] = $recipe_ingredient_array;
    }
}

// Button submit
if (isset($_POST['submit'])) {
    if (strlen(trim($_POST['title'])) == 0) {
        $errors['title'] = 'Titel eingeben.';
    }
    if ($recipeManager->titleExists($_POST['title'])){
        $errors['title_exists'] = 'Titel existiert schon.';
    }
    if (sizeof($recipe_ingredient_array) == 0) {
        $errors['recipe_ingredients'] = 'Zutat hinzufügen.';
    }
    if (strlen(trim($_POST['description'])) == 0) {
        $errors['description'] = 'Beschreibung eingeben.';
    }
    if (count($errors) == 0) {
        $category_id = $categoryManager->getCategoryId($_POST['category']);
        $category = new Category($category_id, $_POST['category']);
        $type_id = $typeManager->getTypeId($_POST['type']);
        $type = new Type($type_id, $_POST['type']);
        $user_id = (int)$_SESSION['user_id'];
        $recipe_ingredient_array = $_SESSION['recipe_ingredients'];
        $recipe_id = $recipeManager->createRecipe(($_POST['title']), ($_POST['description']), $user_id,
            $category, $type, $recipe_ingredient_array);
        if (isset($_POST['picture'])) {
            $photoUrl = $fileUploadManager->uploadImage($_SESSION['user_id'], $recipe_id, ($_POST['picture']));
            $recipeManager->updatePhotoUrl($photoUrl, $recipe_id);
        }
        unset($_SESSION['recipe_ingredients']);
        header('Location: ./confirmation.php');
    }

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
        include "inc/header.inc.php";
        include "inc/navbar.inc.php";
        ?>
    </header>

    <div class="content">
        <h1>Neues Rezept erstellen</h1>
        <form enctype="multipart/form-data" action="recipe.create.form.php" method="post">
            <?php include 'inc/errormessages.inc.php'; ?>
            <div>
                <div>
                    <label for="title">Titel:</label><br/>
                    <input type="text" name="title" id="title"
                           value="<?php if ($_REQUEST != null && $_REQUEST['title'] != null) echo $_REQUEST['title'] ?>">
                </div>

                <div>
                    <label for="category">Kategorie:</label><br/>
                    <select name="category" id="category">
                        <?php
                        foreach ($categories as $category) {
                            $name = $category->getName();
                            ?>
                            <option value='<?php echo $name ?>'><?php echo $name ?></option>";
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
                            <option value='<?php echo $name ?>'><?php echo $name ?></option>";
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <?php
                    if (isset ($_SESSION['recipe_ingredients'])) {
                        $recipe_ingredient_array = $_SESSION['recipe_ingredients'];
                        foreach ($recipe_ingredient_array as $r) {
                            $delete_ingredient = $r->getIngredientName();
                            echo $r->getAmount() . " " .
                                $r->getUnitOfMeasurementName() . " " .
                                $r->getIngredientName() .
                                "<button name=$delete_ingredient>x</button><br/><br/>";
                            if (isset($_POST[$delete_ingredient])) {
                                unset($recipe_ingredient_array[$count]);
                                $_SESSION['recipe_ingredients'] = $recipe_ingredient_array;
                                header('Location: ./recipe.create.form.php');
                            }
                            $count++;
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
                            <option value=" <?php echo $name ?> "><?php echo $name ?></option>";
                            <?php
                        }
                        ?>
                    </select>
                    <button name="add_ingredient">hinzufügen</button>
                </div>
                <div>
                    <label for="description">Beschreibung:</label><br/>
                    <textarea class="description" type="text" name="description" id="description">
                       <?php if ($_REQUEST != null && $_REQUEST['description'] != null)
                           echo ltrim($_REQUEST['description']) ?>
                    </textarea>
                </div>
                <div>
                    <label for="picture">Bild:</label><br>
                    <input class="file_upload" type="file" name="picture" id="picture" accept="image/jpeg, image/png">
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
