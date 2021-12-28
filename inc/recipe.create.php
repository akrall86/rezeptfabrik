<?php
require_once 'inc/maininclude.inc.php';
require_once 'manager/measuringunitmanager.inc.php';
require_once 'manager/recipeingredientmanager.inc.php';
require_once 'manager/categorymanager.inc.php';
require_once 'manager/fileuploadmanager.inc.php';
require_once 'model/recipe_ingredient.inc.php';
require_once 'model/type.inc.php';
require_once 'model/category.inc.php';
require_once 'model/recipe_ingredients.inc.php';
include 'inc/errormessages.inc.php';

$categories = $categoryManager->getCategories();
$types = $typeManager->getTypes();
$measurementUnits = $measuringUnitManager->getMeasuringUnits();
$count = 0;

if (!isset ($_SESSION['recipe_ingredients'])) {
    $_SESSION['recipe_ingredients'] = new Recipe_Ingredients();;
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
        $recipe_ingredients = $_SESSION['recipe_ingredients'];
        $recipe_ingredients->add(new Recipe_Ingredient(
            $_POST['ingredient'], $_POST['measurementUnit'], $_POST['measure']));
        $_SESSION['recipe_ingredients'] = $recipe_ingredients;
    }
}

// Button submit
if (isset($_POST['submit'])) {
    $recipe_ingredients = $_SESSION['recipe_ingredients'];
    if (strlen(trim($_POST['title'])) == 0) {
        $errors['title'] = 'Titel eingeben.';
    }
    if ($recipeManager->titleExists($_POST['title'])) {
        $errors['title_exists'] = 'Titel existiert schon.';
    }
    if ($_SESSION['recipe_ingredients']->count() == 0) {
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
        $user_id = $_SESSION['user_id'];
        $recipe_id = $recipeManager->createRecipe(($_POST['title']), ($_POST['description']), $user_id,
            $category, $type, $recipe_ingredients);

        $filename = $fileUploadManager->uploadImage($user_id, $recipe_id);
        $recipeManager->updatePhotoUrl($filename, $recipe_id);
    }
    unset($_SESSION['recipe_ingredients']);
    header('Location: ./confirmation.php');

}
?>

