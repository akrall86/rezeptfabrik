<?php
require_once __DIR__ . '/../model/recipe_ingredient.inc.php';

// Session start
session_start();

// DB-Connection include
require_once __DIR__ . '/../db/connection.inc.php';
// User Manager include
require_once __DIR__ . '/../manager/usermanager.inc.php';
// Ingredient Manager include
require_once __DIR__ . '/../manager/ingredientmanager.inc.php';
// Recipe Manager include
require_once __DIR__ . '/../manager/recipemanager.inc.php';
// MeasuringUnit Manager include
require_once __DIR__ . '/../manager/measuringunitmanager.inc.php';
// Category Manager include
require_once __DIR__ . '/../manager/categorymanager.inc.php';
// Type Manager include
require_once __DIR__ . '/../manager/typemanager.inc.php';
// RecipeIngredient Manager include
require_once __DIR__ . '/../manager/recipeingredientmanager.inc.php';
// FileUpload Manager include
require_once __DIR__ . '/../manager/fileuploadmanager.inc.php';

// Object from Class UserManager
$userManager = new UserManager($connection);
// Object from Class RecipeManager
$ingredientManager = new IngredientManager($connection);
// Object from Class IngredientManager
$measuringUnitManager = new MeasuringUnitManager($connection);
// Object from Class RecipeIngredientManager
$recipeIngredientManager = new RecipeIngredientManager($connection);
// Object from Class CategoryManager
$categoryManager = new CategoryManager($connection);
// Object from Class TypeManager
$typeManager = new TypeManager($connection);
// Object from Class MeasuringUnitManager
$recipeManager = new RecipeManager($connection, $ingredientManager, $measuringUnitManager,
    $recipeIngredientManager, $userManager, $categoryManager, $typeManager);
// Object from Class FileUploadManager
$fileUploadManager = new FileUploadManager();

// array to store errors
$errors = [];