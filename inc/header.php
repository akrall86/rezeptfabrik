

<div class="logo">
    <img src=img/logo.png width='200px' height='200px' alt=''>
</div>
<div class="title">rezeptfabrik</div>
<div class="authentication">
    <?php if (!$userManager->isLoggedIn()): ?>
        <a href="./login.php">Login</a> </br>
        <a href="./register.php">Registrieren</a>
    <?php else: ?>
        <a href="./profile.php">Profil</a></br>
        <a href="./message.view.php"><i class='bx bxs-envelope'></i></a></br>
        <a href="./logout.php">Logout</a>
    <?php endif; ?>
</div>
