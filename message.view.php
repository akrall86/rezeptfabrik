<?php
require_once 'inc/maininclude.php';
require_once 'inc/sendmessage.php';

$user_id = $_SESSION['user_id'];
$user_ids = $messageManager->getUsersWrittenWith($user_id);

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
        <h1>Deine Nachrichten</h1>
        <?php
        if ($user_ids != null) {
            foreach ($user_ids as $id) {
                if ($id != $user_id) {
                    $user = $userManager->getUserById($id);
                    echo "<a href='message.view.php?id=" . $id . "'>" . $user->getUserName() . "</a>
                    </br>";
                }
            }
        } else echo "<p> Noch keine Nachrichten vorhanden.";

        if (isset($_GET['id'])) {
            $messages = $messageManager->getAllMessages($user_id, (int)$_GET['id']);
            foreach ($messages as $message) {
                if ($message->getFromUserId() === $user_id) {
                    echo "<div class=right>" . $message->getMessageContent() . "</div>
                          <div class=right>" . $message->getSendTime() . "</div>";
                } else {
                    echo "<div class=left>" . $message->getMessageContent() . "</div>
                    <div class=right>" . $message->getSendTime() . "</div>";
                }
            }
        }
        ?>
    </div>

    <?php
    include "inc/footer.php";
    ?>
</div>
</body>
</html>


