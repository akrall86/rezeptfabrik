<header class="center-wrapper">
    <div class="title">rezeptefabrik</div>
    <div class="menu">
        <ul>
            <li><a href="./">Home</a></li>
            <?php if(!$userManager->isLoggedIn()): ?>
                <li><a href="./login.php">Login</a></li>
                <li><a href="./register.php">Registrieren</a></li>
            <?php else: ?>
                <li><a href="./recipe.php">Rezepte</a></li>
                <li><a href="./post_recipe.php">Rezept posten</a></li>
                <li><a href="./profile.php">Profil</a></li>
                <li><a href="./logout.php">Logout</a></li>
            <?php endif; ?>
            <?php if($userManager->isAdmin()): ?>
                <li><a href="./admin.user.php">Administrator Benutzerverwaltung</a></li>
                <li><a href="./admin.recipe.php">Administrator Rezepte verwaltung</a></li>
            <?php endif; ?>
        </ul>
    </div>
</header>