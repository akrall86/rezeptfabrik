<?php
// Session start
session_start();

// DB-Connection include
require_once __DIR__.'/../db/connection.inc.php';
// User Manager include
require_once __DIR__.'/../manager/usermanager.inc.php';
// ?? include


// Object from Class UserManager
$userManager = new UserManager($connection);

// for errors save
$errors = [];