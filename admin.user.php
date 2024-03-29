<?php
require_once 'inc/maininclude.php';
require_once 'inc/requirelogin.php';
require_once 'inc/requireadmin.php';
require_once 'inc/admin.userinclude.php';
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
    <!-- header -->
    <header>
        <?php
        include "inc/header.php";
        include "inc/navbar.php";
        ?>
    </header>

    <!-- content -->
    <div class="content">
        <a href="admin.users.php">Zurück</a>
        <div class="admin_user_data">
            <form action="admin.user.php" method="POST">
                <?php include 'inc/errormessages.php' ?>

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
                    <button name="btdelete" <?php if ($_SESSION['user_id'] == $_REQUEST['id']) echo 'disabled'; ?>>
                        Benutzer löschen
                    </button>
                </div>
            </form>
        </div>
        <div class="admin_user_roles">
            <?php $count = 0;
            if (isset($_POST['btgetroles'])): ?>
                <form action="admin.user.php" method="POST">
                    <table border="solid">
                        <tr>
                            <th>Rollen</th>
                            <th><label for="has_role">Zugewiesen</label></th>
                        </tr>
                        <?php foreach ($roles as $role): ?>
                            <tr>
                                <td><?php echo $role->name ?></td>
                                <td><input type="checkbox" name="has_role<?php echo $count ?>"
                                           id="has_role<?php echo $count ?>"
                                           value="<?php echo $role->name ?>"
                                        <?php
                                        foreach ($userManager->getUserRoles($user->id) as $userrole) {
                                            if ($userrole->name === $role->name) {
                                                echo 'checked';
                                            }
                                        }
                                        $count++; ?>
                                    >
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <input type="hidden" name="id" value="<?php echo $user->id ?>">
                        <input type="hidden" name="count" value="<?php echo $count ?>">
                    </table>
                    <div>
                        <label for="password">Mit Admin Passwort bestätigen</label>
                        <input type="password" name="password" id="password">
                    </div>
                    <button name="btupdaterole">Rollen zuweisen</button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- footer -->
    <?php include 'inc/footer.php'; ?>
</div>
</body>
</html>