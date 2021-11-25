<?php
// DB-Connection Attribute
$host = "localhost:3307";
$dbName = "rezeptfabrik";
$dbUsername = "root";
$dbPassword = "";

// get DB connection
$connection = new PDO("mysaql:dbname=$dbName; host=$host;", $dbUsername, $dbPassword);
$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
