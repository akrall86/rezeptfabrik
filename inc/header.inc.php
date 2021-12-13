    <div class="logo">
        <img src=img/logo.png width='200px' height='200px' alt=' '>
    </div>
    <div class="title">rezeptfabrik</div>
    <div class="authentication">
        <?php if (!$userManager->isLoggedIn()): ?>
            <a href="./login.php">Login</a>
            <a href="./register.php">Registrieren</a>
        <?php else: ?>
            <a href="./profile.php">Profil</a>
            <a href="./logout.php">Logout</a>
        <?php endif; ?>
    </div>
