<?php if (!$userManager->isAdmin()): ?>
    <p><strong>Admin- Rechte notwendig!</strong></p>
    <meta http-equiv="refresh" content="2; URL=./">
    <?php
    die();
endif;
?>