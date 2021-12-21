<?php
require_once 'inc/maininclude.inc.php';
require_once 'inc/logininclude.inc.php';
require_once 'inc/requireadmin.inc.php';
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
        include "inc/header.inc.php";
        include "inc/navbar.inc.php";
        ?>
    </header>

    <div class="content">
        <a href="admin.index.php">Zurück</a>
            <table>
                <?php if (count($users) == 0) {
                    echo '<p> Es wurden keine Benutzer gefunden! </p>';
                } else {
                    echo ' 
                    <tr>
                        <th>Vorname</th>
                        <th>Nachname</th>
                        <th>Benutzername</th>
                        <th>E-Mail</th>
                        <th>Bearbeiten</th>
                   </tr>';
                }

                foreach ($users as $user) {
                    echo "<tr>
                                <td>$user->firstname</td>
                                <td>$user->lastname</td>
                                <td>$user->user_name</td>
                                <td>$user->email</td>
                                <td><a href='admin.user.php?id=$user->id'>Bearbeiten</a> </td>
                           </tr>";
                }
                ?>
            </table>
        <?php
        include "inc/footer.inc.php";
        ?>
    </div>
</div>
</body>
</html>
