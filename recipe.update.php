<?php
include 'inc/errormessages.inc.php';
include 'manager/measuringunitmanager.inc.php';

$measurementUnits = $measuringUnitManager->getMeasuringUnits();
?>

    <h1>Rezept ändern</h1>
    <form action="./recipe.update.php" method="post">
        <div>
            <label for="typ">Typ:</label><br>
            <input type="text" name="typ" id="typ" value="<?php echo $recipe->typ ?>">
        </div>
        <div>
            <label for="category">Kategorie:</label><br>
            <input type="text" name="category" id="category" value="<?php echo $recipe->category ?>">
        </div>
        <div>
            <input type="text" name="title" id="title" value="<?php echo "<h2>" . $recipe->title . "</h2>" ?>">
        </div>
        <div>
            <label for="title">Zutaten:</label><br>
            <input type="text" name="title" id="title" value="<?php echo "<h2>" . $recipe->title . "</h2>" ?>">
        </div>
        <div>
            <button name="submit">Speichern</button>
        </div>
    </form>

<?php if (isset($immo)): ?>
    <h3>Bild</h3>
    <?php
    if (strlen($immo->fotoUrl ?? '') != 0):
        ?>
        <img src="<?php echo $uploadManager->getImagePath($immo); ?>" style="max-width: 300px; max-height: 300px;">

    <?php endif; ?>