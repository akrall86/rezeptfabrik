<?php
require_once __DIR__ . '/../inc/maininclude.inc.php';
require_once __DIR__ . '/../model/category.inc.php';
require_once __DIR__ . '/../model/ingredient.inc.php';
require_once __DIR__ . '/../model/recipe.inc.php';
require_once __DIR__ . '/../model/recipe_ingredient.inc.php';
require_once __DIR__ . '/../model/unit_of_measurement.inc.php';

/**
 * The RecipeManager class contains methods for managing recipes and editing recipes in db
 */
class RecipeManager {
    private PDO $connection;
    private IngredientManager $ingredientManager ;
    private MeasuringUnitManager $measuringUnitManager;
    private RecipeIngredientManager $recipeIngredientManager;

    /**
     * @param PDO $conn the connection to the db
     * @param IngredientManager $ingredientManager
     * @param MeasuringUnitManager $measuringUnitManager
     * @param RecipeIngredientManager $recipeIngredientManager
     */
    public function __construct(PDO $connection, IngredientManager $ingredientManager,
                                MeasuringUnitManager $measuringUnitManager,
                                RecipeIngredientManager $recipeIngredientManager) {
        $this->connection = $connection;
        $this->ingredientManager = $ingredientManager;
        $this->measuringUnitManager = $measuringUnitManager;
        $this->recipeIngredientManager = $recipeIngredientManager;
    }

    /**
     * insert recipe, ingredients and unit_of_measurement into DB
     * @param string $title_name
     * @param string $content
     * @param int $user_id
     * @param Category $category
     * @param Type $type
     * @param array $recipe_ingredients
     * @return string|array $id of the recipe or $errors[] if title is already in use
     */
    function createRecipe(
        string $title_name, string $content, int $user_id, Category $category, Type $type,
        array  $recipe_ingredients): string{
        $slug =strtolower($this->createSlug($title_name));
        $category_id = $category->getId();
        $type_id = $type->getId();
        $date = new DateTime('now');

        $ps = $this->connection->prepare('
        INSERT INTO recipe
        (title, content, slug, user_id, category_id, type_id, photo_url, published_date, rating)
        VALUES 
        (:title, :content, :slug, :user_id, :category_id, :type_id, :photo_url, :published_date, :rating)');

        $ps->bindValue('title', $title_name);
        $ps->bindValue('content', $content);
        $ps->bindValue('slug', $slug);
        $ps->bindValue('user_id', $user_id);
        $ps->bindValue('category_id', $category_id);
        $ps->bindValue('type_id', $type_id);
        $ps->bindValue('photo_url', "");
        $ps->bindValue('published_date', date('Y-m-d H:i:s', $date->getTimestamp()));
        $ps->bindValue('rating', 0);
        $ps->execute();

        $recipe_id = (int)($this->connection->lastInsertId());

        foreach ($recipe_ingredients as $r) {
            $ingredient_name = $r->getIngredientName();
            $ingredient_id = (int)($this->ingredientManager->createIngredient($ingredient_name));
            $unitOfMeasurement_name = (string)($r->getUnitOfMeasurementName());
            $unitOfMeasurement_id = (int)($this->measuringUnitManager->getMeasuringUnitId($unitOfMeasurement_name));
            $amount = $r->getAmount();
            $this->recipeIngredientManager->createRecipe_Ingredient($recipe_id, $ingredient_id, $unitOfMeasurement_id, $amount);
        }
        return $recipe_id;
    }

    /**
     * @param $id
     * @return Recipe|bool
     */
    function getRecipe($id): Recipe|bool {
        $result = $this->connection->query('
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
        $result = $this->connection->query('SELECT * FROM recipe');
        $recipes = [];
        while ($row = $result->fetch()) {
            $recipes[] = new Recipe(
                $row['id'], $row['title'], $row['content'], $row['slug'], $row['user_id'], $row['category_id'],
                $row['type_id'], $row['photo_url'], $row['published_date'], $row['rating']);
        }

        return $recipes;
    }


    function getRecipesByCategory(string $category): array|bool {
        $recipes [] = array();
        $result = $this->connection->query("
            SELECT * FROM recipe WHERE category_id ='.$category.'");
        if ($result->fetch()!=null) {
            while ($row = $result->fetch()) {
                $recipes[] = new Recipe(
                    $row['id'], $row['title'], $row['content'], $row['slug'], $row['user_id'],
                    $row['category_id'], $row['type_id'], $row['photo_url'], $row['published_date'], $row['rating']);
            }
            return $recipes;
        } else {
            return false;
        }

    }

    function getOneRandomRecipeByCategory(string $category): Recipe|bool {
        $recipes = $this->getRecipesByCategory($category);
        if(!is_null($recipes)) {
         return false;
        } else return $recipes[rand(0, sizeof($recipes) - 1)];
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
        $ps = $this->conn->query("UPDATE recipe SET photo_url = :photoUrl WHERE id='.$recipe_id.'");
        $ps->bindValue('photo_url', $photoUrl);
        $ps->execute();
    }

    private function createSlug(string $title): string {
        $string = str_replace(" ", "-", $title);
        $slug = str_replace(array("#", "'", ";", ".", "\"", ",", ":"), "", $string);
        return $slug;
    }

    /**
     * checks whether the title already exists
     * @param string $title
     * @return bool  true, if title already exists, false otherwise
     */
    function titleExists(string $title): bool {
        $result = $this->connection->query("SELECT id FROM recipe WHERE title='.$title.'");
        if ($result->fetch() > 0) {
            return true;
        } else return false;
    }


}

