<?php
include 'inc/errormessages.inc.php';
include 'manager/measuringunitmanager.inc.php';

$measurementUnits = $measuringUnitManager -> getMeasuringUnits();

?>
    <h1>Neues Rezept erstellen</h1>
    <form action="./recipe.create.php" method="post">
        <div>
            <label for="typ">Typ:</label><br>
            <input type="text" name="typ" id="typ">
        </div>
        <div>
            <label for="category">Kategorie:</label><br>
            <input type="text" name="category" id="category">
        </div>
        <div>
            <label for="title">Name:</label><br>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="title">Zutaten:</label><br>
            <input type="text" name="title" id="title" >

            <select name="unit_of_measurement">
                 <?php foreach ($measurementUnits as $measurementUnit){
                echo "<option value=" . $measurementUnit . "</option>";
               } ?>
        </div>
        <div>
            <button name="submit">Speichern</button>
        </div>
    </form>
    @param int $user_id
    * @param int $category_id
    * @param int $type_id
    * @param string $photo_url
    * @param DateTime $published_date
    * @param int $rating
<?php if (isset($immo)): ?>
    <h3>Bild</h3>
    <?php
    if (strlen($immo->fotoUrl ?? '') != 0):
        ?>
        <img src="<?php echo $uploadManager->getImagePath($immo);?>" style="max-width: 300px; max-height: 300px;">

    <?php endif;


    ?>