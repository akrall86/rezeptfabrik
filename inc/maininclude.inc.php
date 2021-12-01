<?php
// Session start
session_start();

// DB-Connection include
require_once __DIR__ . '/../db/connection.inc.php';
// User Manager include
require_once __DIR__ . '/../manager/usermanager.inc.php';
// Recipe Manager include
require_once __DIR__ . '/../manager/recipemanager.inc.php';

// Object from Class UserManager
$userManager = new UserManager($connection);
// Object from Class RecipeManager
$recipeManager = new RecipeManager($connection);

// for errors save
$errors = [];