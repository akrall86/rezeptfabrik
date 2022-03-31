<?php
require_once 'inc/maininclude.php';
require_once 'inc/logininclude.php';
require_once 'inc/requireadmin.php';
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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
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
        <br/><br/>
        <table  class='admin_table'>
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
    </div>
    <?php
    include "inc/footer.php";
    ?>

</div>
</body>
</html>
