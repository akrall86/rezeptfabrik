<?php
require_once 'inc/maininclude.php';
require_once 'manager/measuringunitmanager.php';
require_once 'manager/recipeingredientmanager.php';
require_once 'manager/categorymanager.php';
require_once 'manager/typemanager.php';
require_once 'manager/recipemanager.php';

$recipe_id = $_POST['recipe_id'];
require_once 'inc/recipe.update.php';
?>

<!DOCTYPE HTML>
<html lang="de">
<head>
    <meta charset="utf-8"/>
    <title>rezeptfabrik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <script src="js/jquery-3.6.0.js" defer></script>
    <script src="js/script.js" defer></script>
    <script src="https://cdn.tiny.cloud/1/yrzh53e1pluir30xdlmiyrryst09opb6vf7vy441zi3nai5h/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: '#description',
            toolbar: 'undo redo | bold italic underline | numlist bullist',
            plugins: 'lists',
            menubar: ''
        });
    </script>
    <link rel="stylesheet" href="css/style.css"/>
</head>
<body>
<div class="body">
    <header>
        <?php
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <div class="content">
        <h1>Nachricht schreiben</h1>
        <form enctype="multipart/form-data" action="recipe.update.form.php" method="post">
            <?php include 'inc/errormessages.php' ?>

            <div class="description_label">
                <br/>
                <label for="description">Nachricht:</label><br/>
            </div>
            <div class="description_div">
            <textarea class="description" type="text" name="description" id="description">
                       <?php echo $recipe->getContent() ?>
                    </textarea>
                <br/>
                <div>
                    <button name="submit">senden</button>
                </div>
                <br/>
        </form>
    </div>
    <?php
    include "inc/footer.php";
    ?>
</div>


</body>
</html>


