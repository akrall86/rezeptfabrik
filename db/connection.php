<?php
// DB-Connection Attribute
$host = "localhost:3306";
$dbName = "rezeptfabrik";
$dbUsername = "root";
$dbPassword = "";

// get DB connection
$connection = new PDO("mysql:dbname=$dbName; host=$host;", $dbUsername, $dbPassword);
$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
