<div class="menu">
    <ul>
        <?php if (!$userManager->isLoggedIn()): ?>
            <li><a href="./">Home</a></li>

        <?php else: ?>
            <li><a href="./">Home</a></li>
            <li><a href="./recipes.view.php">Rezepte</a></li>
            <li><a href="./recipe.create.form.php">Rezept erstellen</a></li>
        <?php endif; ?>
        <?php if ($userManager->isAdmin()): ?>
            <li><a href="admin.index.php">Administrator Bereich</a></li>

        <?php endif; ?>
    </ul>
</div>


