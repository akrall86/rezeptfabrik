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
    private IngredientManager $ingredientManager;
    private MeasuringUnitManager $measuringUnitManager;
    private RecipeIngredientManager $recipeIngredientManager;
    private UserManager $userManager;
    private CategoryManager $categoryManager;
    private TypeManager $typeManager;

    /**
     * @param PDO $conn the connection to the db
     * @param IngredientManager $ingredientManager
     * @param MeasuringUnitManager $measuringUnitManager
     * @param RecipeIngredientManager $recipeIngredientManager
     * @param UserManager $userManager
     * @param CategoryManager $categoryManager
     * @param TypeManager $typeManager
     */
    public function __construct(PDO                     $connection,
                                IngredientManager       $ingredientManager,
                                MeasuringUnitManager    $measuringUnitManager,
                                RecipeIngredientManager $recipeIngredientManager,
                                UserManager             $userManager,
                                CategoryManager         $categoryManager,
                                TypeManager             $typeManager) {
        $this->connection = $connection;
        $this->ingredientManager = $ingredientManager;
        $this->measuringUnitManager = $measuringUnitManager;
        $this->recipeIngredientManager = $recipeIngredientManager;
        $this->userManager = $userManager;
        $this->categoryManager = $categoryManager;
        $this->typeManager = $typeManager;
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
        array  $recipe_ingredients): string {
        $slug = strtolower($this->createSlug($title_name));
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
     * get one recipe from DB
     * @param int $id of the recipe to be fetched
     * @return Recipe|bool recipe or false if there is no match
     */
    function getRecipe(int $id): Recipe|bool {
        $result = $this->connection->query("
            SELECT r.id AS recipe_id, r.title, r.content, r.slug, r.user_id, r.photo_url, r.published_date, r.rating,
                   t.id AS type_id,	t.name AS type_name, c.id AS category_id, c.name AS category_name, 
                   rhihuom.amount, i.id AS ingredient_id, i.name AS ingredient_name, uom.id AS uom_id, uom.name AS uom_name 	
            FROM recipe r 
            INNER JOIN type t ON r.type_id = t.id 
            INNER JOIN category c ON r.category_id = c.id
            INNER JOIN recipe_has_ingredient_has_unit_of_measurement rhihuom ON r.id = rhihuom.recipe_id
            INNER JOIN ingredient i ON rhihuom.ingredient_id = i.id
            INNER JOIN unit_of_measurement uom ON rhihuom.unit_of_measurement_id = uom.id
            WHERE r.id='$id'");
        $recipe_ingredients[] = array();
        if ($row = $result->fetch()) {
            while ($subset = $result->fetch()) {
                $recipe_ingredients [] = new Recipe_Ingredient($subset['ingredient_name'], $subset['uom_name'], $subset['amount']);
            }
            $user = $this->userManager->getUserById($row['user_id']);
            $category = $this->categoryManager->getCategoryById($row['category_id']);
            $type = $this->typeManager->getTypeById($row['type_id']);
            $published_date = (DateTime::createFromFormat('Y-m-d H:i:s', $row['published_date']));
            $recipe = new Recipe(
                $row['recipe_id'], $row['title'], $row['content'], $row['slug'], $user, $category, $type,
                $row['photo_url'], $published_date, $row['rating'], $recipe_ingredients);
            return $recipe;
        }
        return false;
    }


    /**
     * get all recipes from DB
     * @return array array of recipes or false if there is no match
     */
    function getAllRecipes(): array|bool {
        $recipe_ids [] = array();
        $result = $this->connection->query('SELECT id FROM recipe');
        if ($result->fetch() != null) {
            while ($row = $result->fetch()) {
                $recipe_ids [] = $row['id'];
            }
            foreach ($recipe_ids as $id) {
                $recipes [] = $this->getRecipe($id);
            }
            return $recipes;
        }
        return false;
    }

    /**
     * get all recipes from a specific category from DB
     * @param $category
     * @return array one recipe or array of recipes or false if there is no match
     */
    function getRecipesByCategory(string $category): Recipe|array|bool {
        $category_id = $this->categoryManager->getCategoryId($category);
        $recipes [] = array();
        $recipe_ids [] = array();
        $result = $this->connection->query("
            SELECT id FROM recipe WHERE category_id ='$category_id'");
        if ($result->rowCount() === 1) {
            $row = $result->fetch();
            return $this->getRecipe($row['id']);
        } else if ($result->rowCount() > 1) {
            while ($row = $result->fetch()) {
                $recipe_ids [] = $row['id'];
            }
            foreach ($recipe_ids as $id) {
                $recipes [] = $this->getRecipe($id);
            }
            return $recipes;
        }
        return false;
    }

    function getOneRandomRecipeByCategory(string $category): Recipe|bool {
        $recipes = $this->getRecipesByCategory($category);
        if (gettype($recipes) == array()) {
            $random_number = rand(0, (sizeof($recipes) - 1));
            $recipe = $recipes[$random_number];
            return $recipe;
        } else if ($recipes instanceof Recipe) {
            return $recipes;
        }
        return false;
    }

    function displayRecipe(Recipe $recipe) {
        $user = $recipe->getUser();
        $category = $recipe->getCategory();
        $type = $recipe->getType();
        $date = $recipe->getPublishedDate();
        echo "
            <div class= 'flex_container_recipe'> 
                <div class= 'flex_item_recipe_content'>
                    <p>" . $user->getUserName() . " hat dieses Rezept am " .
            $date->format('d.m.Y') . " um " . $date->format('H:i:s') . " gepostet.
                    </p> 
                    <h2>" . $recipe->getTitle() . "</h2> 
                    <p>" . $category->getName() . " | " . $type->getName() . "</p> 
                    <p>Bewertung: " . $recipe->getRating() . "</p> 
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
        $ps = $this->conn->query("UPDATE recipe SET photo_url = :photoUrl WHERE id='$recipe_id'");
        $ps->bindValue('photo_url', $photoUrl);
        $ps->execute();
    }

    private
    function createSlug(string $title): string {
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
        if ($result->fetch()) {
            return true;
        } else return false;
    }


}

