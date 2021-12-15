<?php
require_once 'inc/maininclude.inc.php';
require_once 'inc/requirelogin.inc.php';
require_once 'inc/requireadmin.inc.php';
require_once 'inc/admin.userinclude.inc.php';
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
    <!-- header -->
    <header>
        <?php
        include "inc/header.inc.php";
        include "inc/navbar.inc.php";
        ?>
    </header>

    <!-- content -->
    <div class="content">
        <div class="admin_user_data">
            <form action="admin.user.php" method="POST">

                <?php include 'inc/errormessages.inc.php' ?>
                <div>
                    <label for="id">Id:</label>
                    <input type="text" name="id" id="id" value="<?php echo $user->id ?>" readonly>
                </div>
                <div>
                    <label for="firstname">Vorname:</label>
                    <input type="text" name="firstname" id="firstname" value="<?php echo $user->firstname ?>">
                </div>
                <div>
                    <label for="lastname">Nachname:</label>
                    <input type="text" name="lastname" id="lastname" value="<?php echo $user->lastname ?>">
                </div>
                <div>
                    <label for="user_name">Benutzername:</label>
                    <input type="text" name="user_name" id="user_name" value="<?php echo $user->user_name ?>">
                </div>
                <div>
                    <label for="email">E-Mail:</label>
                    <input type="email" name="email" id="email" value="<?php echo $user->email ?>">
                </div>

                <div>
                    <label for="newpassword">Neues Passwort:</label>
                    <input type="password" name="newpassword" id="newpassword">
                </div>
                <div>
                    <label for="password">Mit Admin Passwort bestätigen</label>
                    <input type="password" name="password" id="password">
                </div>

                <div>
                    <button name="btupdate">Daten aktualisieren</button>
                    <button name="btgetroles">Benutzer Rollen anzeigen</button>
                    <button name="btdelete">Benutzer löschen</button>
                </div>
            </form>
        </div>
        <div class="admin_user_roles">
            <?php if (isset($_POST['btgetroles'])): ?>
                <form action="admin.user.php" method="POST">
                    <table border="solid">
                        <tr>
                            <th>Rollen</th>
                            <th><label for="has_role">Zugewiesen</label></th>
                        </tr>
                        <?php foreach ($roles as $role): ?>
                        <tr>
                            <td><?php echo $role->name?></td>
                            <td><input type="checkbox" name="has_role" id="has_role"></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    <button name="btupdaterole">Rollen zuweisen</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- footer -->
    <?php include 'inc/footer.inc.php'; ?>
</div>
</body>
</html>