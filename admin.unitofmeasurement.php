<?php
require_once 'inc/maininclude.php';

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
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <div class="content">
        <h1>Maßeinheiten</h1>

        <a href="admin.index.php">Zurück</a>
        <br/><br/>
        <?php
        $unitofmeasurements = $measuringUnitManager->getMeasuringUnits();
        if (count($unitofmeasurements) == 0) {
            echo '<p> Noch keine Maßeinheiten vorhanden. </p>';
        } else {
            echo " <table class='admin_table'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>                
                    </tr>";
        }
        foreach ($unitofmeasurements as $unitofmeasurement) {
            $id = $unitofmeasurement->getId();
            $name = $unitofmeasurement->getName();
            echo "  <tr>
                       <td>" . $id . "</td>
                        <td>" . $name . "</td>                      
                        </td>
                   </tr>";
        }
        echo "</table>

          <form action='admin.unitofmeasurement.php' method='POST'>
        <div>
            <label for='name'>Neue Maßeinheit hinzufügen:</label>
            <input type='text' name='name' id='name'>                    
            <button name='add'>hinzufügen</button>
        </div>
           </form>";
        if (isset($_POST['add'])) {
            $measuringUnitManager->createMeasuringUnit($_POST['name']);
            header("Location: ./admin.unitofmeasurement.php");
        }

        ?>
    </div>
    <?php
    include "inc/footer.php";
    ?>

</div>
</body>
</html>
