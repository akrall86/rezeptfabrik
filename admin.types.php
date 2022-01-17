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
        <a href="admin.index.php">Zurück</a>

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
                        <td><a href='recipe.delete.php?id=$type_id'>Bearbeiten</a> </td>
                   </tr>";
        }
        echo "</table>";

        include "inc/footer.php";
        ?>
    </div>
</div>
</body>
</html>
