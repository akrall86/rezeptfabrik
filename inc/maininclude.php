<?php
require_once __DIR__ . '/../model/recipe_ingredient.php';

// Session start
session_start();

// DB-Connection include
require_once __DIR__ . '/../db/connection.php';
// User Manager include
require_once __DIR__ . '/../manager/usermanager.php';
// Ingredient Manager include
require_once __DIR__ . '/../manager/ingredientmanager.php';
// Recipe Manager include
require_once __DIR__ . '/../manager/recipemanager.php';
// MeasuringUnit Manager include
require_once __DIR__ . '/../manager/measuringunitmanager.php';
// Category Manager include
require_once __DIR__ . '/../manager/categorymanager.php';
// Type Manager include
require_once __DIR__ . '/../manager/typemanager.php';
// RecipeIngredient Manager include
require_once __DIR__ . '/../manager/recipeingredientmanager.php';
// FileUpload Manager include
require_once __DIR__ . '/../manager/fileuploadmanager.php';
// Rating Manager include
require_once __DIR__ . '/../manager/ratingmanager.php';
// Message Manager include
require_once __DIR__ . '/../manager/messagemanager.php';

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
// Object from Class RatingManager
$ratingManager = new RatingManager($connection);
// Object from Class MeasuringUnitManager
$recipeManager = new RecipeManager($connection, $ingredientManager, $measuringUnitManager,
    $recipeIngredientManager, $userManager, $categoryManager, $typeManager, $ratingManager);
// Object from Class FileUploadManager
$fileUploadManager = new FileUploadManager();
// Object from Class FileUploadManager
$messageManager = new MessageManager($connection);

// array to store errors
$errors = [];