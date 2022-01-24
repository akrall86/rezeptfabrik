<?php
require_once 'inc/maininclude.php';
$users = $userManager->getUsers();
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
        <h1>Typen</h1>
        <a href="admin.index.php">Zurück</a>
        <br/><br/>
        <?php
        $types = $typeManager->getTypes();
        if (count($types) == 0) {
            echo '<p> Noch keine Typen vorhanden. </p>';
        } else {
            echo " <table class='admin_table'>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                      </tr>";
        }
        foreach ($types as $type) {
            $type_id = $type->getId();
            echo "  <tr>
                        <td>" . $type->getId() . "</td>
                        <td>" . $type->getName() . "</td>
                    </tr>";
        }
        echo "</table>
        <form action='admin.types.php' method='POST'>
                <?php include 'inc/errormessages.php' ?>
        <div>
            <label for='name'>Neuen Typ hinzufügen:</label>
            <input type='text' name='name' id='name'>                    
            <button name='add'>hinzufügen</button>
        </div>";

        if (isset($_POST['add'])) {
            $typeManager->createType($_POST['name']);
            header("Location: ./admin.types.php");
        }
        echo "</div>";
        include "inc/footer.php";
        ?>

    </div>
</body>
</html>
