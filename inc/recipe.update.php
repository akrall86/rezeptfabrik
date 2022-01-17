<?php
require_once 'inc/maininclude.php';
require_once 'manager/measuringunitmanager.php';
require_once 'manager/recipeingredientmanager.php';
require_once 'manager/categorymanager.php';
require_once 'manager/fileuploadmanager.php';
require_once 'manager/typemanager.php';
require_once 'manager/recipemanager.php';
require_once 'manager/usermanager.php';
require_once 'model/recipe_ingredient.php';
require_once 'model/type.php';
require_once 'model/category.php';
require_once 'model/recipe_ingredients.php';
require_once 'inc/errormessages.php';
require_once 'inc/recipe.update.php';


$user_id = (int) $_SESSION['user_id'];
$user = $userManager->getUserById($user_id);
$recipe = $recipeManager->getRecipe($recipe_id);
$recipe_ingredients = $recipeIngredientManager->getAllIngredientsFromRecipe($recipe);
$measurementUnits = $measuringUnitManager->getMeasuringUnits();
$categories = $categoryManager->getCategories();
$types = $typeManager->getTypes();

$_SESSION['recipe_ingredients'] = $recipe_ingredients;

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
    if (count($_SESSION['recipe_ingredients']) == 0) {
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
        $slug = $recipeManager->createSlug($_POST['title']);
        $new_recipe = new Recipe($recipe_id, $_POST['title'], $_POST['description'], $slug, $user,
            $category, $type, $recipe->getPhotoUrl(),
        $recipe->getPublishedDate(), $recipe->getRating(), $recipe_ingredients);
        $recipeManager->updateRecipe($new_recipe);

        unset($_SESSION['recipe_ingredients']);
        header('Location: ./confirmation.php');
    }
}

// Button image
if (isset($_POST['image'])) {
    $filename = $fileUploadManager->uploadImage($user_id, $recipe_id);
    $recipeManager->updatePhotoUrl($filename, $recipe_id);
    header('Location: ./confirmation.php');
}

// Button delete
if (isset($_POST['delete'])) {
    $recipeManager->deleteRecipe($recipe);
    header('Location: ./confirmation.php');
}


?>

