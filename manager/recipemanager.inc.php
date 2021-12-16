<?php
require_once __DIR__ . '/../model/recipe.inc.php';
require_once __DIR__ . '/../model/recipe_ingredient.inc.php';
require_once __DIR__ . '/../inc/maininclude.inc.php';

/**
 * The RecipeManager class contains methods for managing recipes and editing recipes in db
 */
class RecipeManager {
    private PDO $conn;

    /**
     * @param PDO $connection the connection to the DB
     */
    function __construct(PDO $connection) {
        $this->conn = $connection;
    }

    /**
     * insert recipe, ingredients and unit_of_measurement into DB
     * @param string $title_name
     * @param string $content
     * @param User $user
     * @param Category $category
     * @param Type $type
     * @param array $recipe_ingredients
     * @return string $id of the recipe or $errors[] if title is already in use
     */
    function createRecipe(
        string $title_name, string $content, User $user, Category $category, Type $type,
        array $recipe_ingredients) : int {
        if ($this->titleExists($title_name) == true) {
            return $errors['title'] = 'Titel wird schon verwendet!';
        }

        $slug = $this->createSlug($title_name);
        $user_id = $user->getId();
        $category_id = $category->getId();
        $type_id = $type->getId();

        $ps = $this->conn->prepare('
        INSERT INTO recipe
        (title, content, slug, user_id, category_id, type_id, photo_url, published_date, rating)
        VALUES 
        (:title, :content, :slug, :user_id, :category_name, :type_name, :photo_url, :published_date, :rating)');

        $ps->bindValue('title', $title_name);
        $ps->bindValue('content', $content);
        $ps->bindValue('slug', $slug);
        $ps->bindValue('user_id', $user_id);
        $ps->bindValue('category_id', $category_id);
        $ps->bindValue('type_id', $type_id);
        $ps->bindValue('photo_url', "");
        $ps->bindValue('published_date', date('Y-m-d H:i:s', (new DateTime('now'))));
        $ps->bindValue('rating', 0);
        $ps->execute();

        $recipe_id = $this->conn->lastInsertId();

        foreach ($recipe_ingredients as $r) {
            $ingredient_name = $r->getIngredientName();
            $ingredient_id = $ingredientManager->createIngredient();
            $unitOfMeasurement_name = $r->getUnitOfMeasurementName();
            $unitOfMeasurement_id = $measuringUnitManager->getMeasuringUnitId($unitOfMeasurement_name);
            $amount = $r->getAmount();
            $ps2 = $this->conn->prepare('
        INSERT INTO recipe_has_ingredient_has_unit_of_measurement
        (recipe_id, ingredient_id, unit_of_measurement_id, amount)
        VALUES 
        (:recipe_id, :ingredient_id, :unit_of_measurement_id, :amount)');
            $ps2->bindValue('recipe_id', $recipe_id);
            $ps2->bindValue('ingredient_id', $ingredient_id);
            $ps2->bindValue('unit_of_measurement_id', $unitOfMeasurement_id);
            $ps2->bindValue('amount', $amount);
            $ps->execute();
        }
        return $recipe_id;
    }

    /**
     * @param $id
     * @return Recipe|bool
     */
    function getRecipe($id): Recipe|bool {
        $result = $this->conn->query('
SELECT * 
FROM recipe r 
INNER JOIN type t ON r.type_id = t.id
INNER JOIN category c ON r.category_id = c.id
INNER JOIN recipe_has_ingredient_has_unit_of_measurement rhihuom ON r.id = rhihuom.recipe_id
INNER JOIN ingredient i ON rhihuom.ingredient_id = i.id
INNER JOIN unit_of_measurement uom ON rhihuom.unit_of_measurement_id = uom.id
WHERE r.id=$id');

        while ($row = $ps->fetch()) {
            $recipe = new Recipe(
                $row['id'], $row['title'], $row['content'], $row['slug'], $row['user_id'], $row['category_id'],
                $row['type_id'], $row['photo_url'], $row['published_date'], $row['rating'], $row['recipe_ingredients']);


        }
        return false;
    }


    /**
     * @return array
     */
    function getRecipes(): array {
        $result = $this->conn->query('SELECT * FROM recipe');
        $recipes = [];
        while ($row = $result->fetch()) {
            $recipes[] = new Recipe(
                $row['id'], $row['title'], $row['content'], $row['slug'], $row['user_id'], $row['category_id'],
                $row['type_id'], $row['photo_url'], $row['published_date'], $row['rating']);
        }

        return $recipes;
    }


    function getRecipesByCategory(string $category): array {
        $result = $this->conn->query('
            SELECT * FROM recipe WHERE category_name = ' . $category);
        if ($result->fetch()) {
            while ($row = $result->fetch()) {
                $recipes[] = new Recipe(
                    $row['id'], $row['title'], $row['content'], $row['slug'], $row['user_id'],
                    $row['category_id'], $row['type_id'], $row['photo_url'], $row['published_date'], $row['rating']);
            }
        } else echo "<p> noch kein Rezept vorhanden.</p>";
        return $recipes;
    }

    function getOneRandomRecipeByCategory(string $category): Recipe {
        $recipes = $this->getRecipesByCategory($category);
        return $recipes[rand(0, sizeof($recipeManager->getRecipeByCategory($category)) - 1)];
    }

    function displayRecipe(Recipe $recipe) {
        $user = $userManager->$recipe->getUser();
        echo "
            <div class= 'flex_container_recipe'> 
                <div class= 'flex_item_recipe_content'>
                    <p>" . $user->getUserName() . "hat dieses Rezept am " .
            $recipe->getPublishedDate()->format('Y-m-d H:i:s') . " gepostet.
                    </p> 
                    <h2>" . $recipe->getTitle() . "</h2> 
                    <p>" . $recipe->getCategory() . " " . $recipe->getType() . "</p> 
                    <p>" . $recipe->getRating() . "</p> 
                    <p>" . $recipe->getContent() . "</p>
                </div>
                <div class= 'flex_item_recipe_picture'>";
        $photoUrl = $recipe->getPhotoUrl();
        if (strlen($photoUrl) != 0) {
            echo "<img src=$photoUrl alt='Bild des Rezeptes'>";
        }
        echo " </div>
            </div>";
    }


    function getRecipeById($id) {

    }

    function updatePhotoUrl(string $photoUrl, int $recipe_id) {
        $ps = $this->conn->query('UPDATE recipe SET photo_url = :photoUrl WHERE id='.$recipe_id);
        $ps->bindValue('photo_url', $photoUrl);
        $ps->execute();
    }

    private function createSlug(string $title): string {
        $string = str_replace(" ", "-", $title);
        $slug = str_replace(array("#", "'", ";", ".", "\"", ",", ":"), "", $string);
        return $slug;
    }

    private function titleExists(string $name): bool {
        $result = $this->conn->query('SELECT * FROM title WHERE name='.$name);
        if($result->fetch()) {
            return true;
        } else return false;
    }



}

