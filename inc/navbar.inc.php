    <div class="menu">
        <ul>
            <li><a href="./index.php">Home</a></li>
            <?php if(!$userManager->isLoggedIn()): ?>
                <li class="login_register"><a href="./login.php">Login</a></li>
                <li class="login_register"><a href="./register.php">Registrieren</a></li>
            <?php else: ?>
                <li><a href="./recipe.php">Rezepte</a></li>
                <li><a href="./post_recipe.php">Rezept posten</a></li>
                <li class="login_register"><a href="./profile.php">Profil</a></li>
                <li class="login_register"><a href="./logout.php">Logout</a></li>
            <?php endif; ?>
            <?php if($userManager->isAdmin()): ?>
                <li><a href="./admin.user.php">Administrator Benutzerverwaltung</a></li>
                <li><a href="./admin.recipe.php">Administrator Rezepteverwaltung</a></li>
            <?php endif; ?>
        </ul>
    </div>
