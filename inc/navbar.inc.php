<div class="menu">
    <ul>
        <?php if (!$userManager->isLoggedIn()): ?>
            <li><a href="./index.php">Home</a></li>
            <li><a href="./recipe.php">Rezepte</a></li>
            <li><a href="./post_recipe.php">Rezept posten</a></li>

        <?php endif; ?>
        <?php if ($userManager->isAdmin()): ?>
            <li><a href="./admin.user.php">Administrator Benutzerverwaltung</a></li>
            <li><a href="./admin.recipe.php">Administrator Rezepteverwaltung</a></li>
        <?php endif; ?>
    </ul>
</div>


