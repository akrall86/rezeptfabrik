<?php
// Session start
session_start();

// DB-Connection include
require_once __DIR__ . '/../db/connection.inc.php';
// User Manager include
require_once __DIR__ . '/../manager/usermanager.inc.php';
// Recipe Manager include
require_once __DIR__ . '/../manager/recipemanager.inc.php';
// Ingredient Manager include
require_once __DIR__ . '/../manager/ingredientmanager.inc.php';
// MeasuringUnit Manager include
require_once __DIR__ . '/../manager/measuringunitmanager.inc.php';

// Object from Class UserManager
$userManager = new UserManager($connection);
// Object from Class RecipeManager
$recipeManager = new RecipeManager($connection);
// Object from Class IngredientManager
$ingredientManager = new IngredientManager($connection);
// Object from Class MeasuringUnitManager
$measuringUnitManager = new MeasuringUnitManager($connection);

// array to store errors
$errors = [];