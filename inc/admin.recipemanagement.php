<?php
if (isset($_POST['getrecipes'])) {
    header("Location: ./admin.recipes.php");
}

if (isset($_POST['getunitofmeasurement'])) {
    header("Location: ./admin.unitofmeasurement.php");
}

if (isset($_POST['gettypes'])) {
    header("Location: ./admin.types.php");
}

if (isset($_POST['getcategories'])) {
    header("Location: ./admin.categories.php");
}
?>
