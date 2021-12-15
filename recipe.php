<?php
require_once 'inc/maininclude.inc.php';

$categories = $categoryManager->getCategories();
$types = $typeManager->getTypes();
?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <title>rezeptfabrik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="body">
    <header>
        <?php
        include "inc/header.inc.php";
        include "inc/navbar.inc.php";
        ?>
    </header>

    <div class="content">

        <h1>Rezepte</h1>
        <form action="./recipe.php" method="post">
            <div>
                <label for="title">Filtern nach Kategorie:</label><br>
                <select name="category" id="category">
                    <?php
                    foreach ($categories as $category) {
                        $name = $category->getName()
                        ?>
                        <option value='<?php $name ?>'><?php echo $name ?></option>";
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div>
                <button name="filterCategory">filtern</button>
            </div>
        </form>
        <form action="./recipe.php" method="post">
            <div>
                <label for="type">Filtern nach Typ:</label><br>
                <select name="type" id="type">
                <?php
                foreach ($types as $type) {
                    $name = $type->getName()
                    ?>
                    <option value='<?php $name ?>'><?php echo $name ?></option>";
                    <?php
                }
                ?>
                </select>
            </div>
            <div>
                <button name="filterType">filtern</button>
            </div>
        </form>
    </div>

    <?php
    include "inc/footer.inc.php";
    ?>
</div>

</body>
</html>

