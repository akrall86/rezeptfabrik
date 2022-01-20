<?php
require_once __DIR__ . '/../inc/maininclude.php';
require_once __DIR__ . '/../model/category.php';
require_once __DIR__ . '/../model/ingredient.php';
require_once __DIR__ . '/../model/recipe.php';
require_once __DIR__ . '/../model/recipe_ingredient.php';
require_once __DIR__ . '/../model/unit_of_measurement.php';
require_once __DIR__ . '/../model/recipe_ingredients.php';
require_once __DIR__ . '/../model/recipes.php';

/**
 * The RecipeManager class contains methods for managing recipes, display recipes
 * and editing recipes in db
 */
class RecipeManager
{
    private PDO $connection;
    private IngredientManager $ingredientManager;
    private MeasuringUnitManager $measuringUnitManager;
    private RecipeIngredientManager $recipeIngredientManager;
    private UserManager $userManager;
    private CategoryManager $categoryManager;
    private TypeManager $typeManager;
    private RatingManager $ratingManager;

    /**
     * @param PDO $conn the connection to the db
     * @param IngredientManager $ingredientManager
     * @param MeasuringUnitManager $measuringUnitManager
     * @param RecipeIngredientManager $recipeIngredientManager
     * @param UserManager $userManager
     * @param CategoryManager $categoryManager
     * @param TypeManager $typeManager
     * @param RatingManager $ratingManager
     */
    public function __construct(PDO                     $connection,
                                IngredientManager       $ingredientManager,
                                MeasuringUnitManager    $measuringUnitManager,
                                RecipeIngredientManager $recipeIngredientManager,
                                UserManager             $userManager,
                                CategoryManager         $categoryManager,
                                TypeManager             $typeManager,
                                RatingManager           $ratingManager)
    {
        $this->connection = $connection;
        $this->ingredientManager = $ingredientManager;
        $this->measuringUnitManager = $measuringUnitManager;
        $this->recipeIngredientManager = $recipeIngredientManager;
        $this->userManager = $userManager;
        $this->categoryManager = $categoryManager;
        $this->typeManager = $typeManager;
        $this->ratingManager = $ratingManager;
    }

    /**
     * insert recipe, ingredients and unit_of_measurement into DB
     * @param string $title_name
     * @param string $content
     * @param int $user_id
     * @param Category $category
     * @param Type $type
     * @param array $recipe_ingredients
     * @return string $id of the created recipe
     */
    function createRecipe(string $title_name, string $content, int $user_id, Category $category, Type $type,
                          array  $recipe_ingredients): string
    {
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

        $recipe_id = ($this->connection->lastInsertId());

        foreach ($recipe_ingredients as $r) {
            $ingredient_name = $r->getIngredientName();
            $ingredient_id = ($this->ingredientManager->createIngredient($ingredient_name));
            $unitOfMeasurement_name = ($r->getUnitOfMeasurementName());
            $unitOfMeasurement_id = ($this->measuringUnitManager->getMeasuringUnitId($unitOfMeasurement_name));
            $amount = $r->getAmount();
            $this->recipeIngredientManager->createRecipe_Ingredient($recipe_id, $ingredient_id, $unitOfMeasurement_id, $amount);
        }
        return $recipe_id;
    }

    /**
     * creates a slug from the title
     * @param string $title the title from which the slug is to be created
     * @return string the slug
     */
    function createSlug(string $title): string
    {
        $string = str_replace(" ", "-", $title);
        $slug = str_replace(array("#", "'", ";", ".", "\"", ",", ":"), "", $string);
        return $slug;
    }

    /**
     * get all recipes from DB
     * @return Recipe|Recipes|bool one recipe or recipes or false if there is no recipe in the DB
     */
    function getAllRecipes(): array
    {
        $recipes = [];
        $result = $this->connection->query('SELECT id FROM recipe');
        while ($row = $result->fetch()) {
            $recipes[] = $this->getRecipe($row['id']);
        }
        return $recipes;
    }

    /**
     * get one recipe from DB
     * @param int $id of the recipe to be fetched
     * @return Recipe|bool recipe or false if there is no match
     */
    function getRecipe(int $id): Recipe|bool
    {
        $result = $this->connection->query("
            SELECT r.id AS recipe_id, r.title, r.content, r.slug, r.user_id, r.photo_url, r.published_date, r.rating,
                   t.id AS type_id,	t.name AS type_name, c.id AS category_id, c.name AS category_name, 
                   rhihuom.amount AS amount, i.id AS ingredient_id, i.name AS ingredient_name, uom.id AS uom_id, uom.name AS uom_name 	
            FROM recipe r 
            INNER JOIN type t ON r.type_id = t.id 
            INNER JOIN category c ON r.category_id = c.id
            INNER JOIN recipe_has_ingredient_has_unit_of_measurement rhihuom ON r.id = rhihuom.recipe_id
            INNER JOIN ingredient i ON rhihuom.ingredient_id = i.id
            INNER JOIN unit_of_measurement uom ON rhihuom.unit_of_measurement_id = uom.id
            WHERE r.id='$id'");
        $recipe_ingredients = [];
        if ($row = $result->fetch()) {
            $user = $this->userManager->getUserById($row['user_id']);
            $category = $this->categoryManager->getCategoryById($row['category_id']);
            $type = $this->typeManager->getTypeById($row['type_id']);
            $published_date = (DateTime::createFromFormat('Y-m-d H:i:s', $row['published_date']));
            $recipe = new Recipe(
                $row['recipe_id'], $row['title'], $row['content'], $row['slug'], $user, $category, $type,
                $row['photo_url'], $published_date, $row['rating'], $recipe_ingredients);
            do {
                $recipe_ingredients [] =
                    new Recipe_Ingredient($row['ingredient_name'], $row['uom_name'], $row['amount']);
            } while ($row = $result->fetch());
            $recipe->setRecipeIngredients($recipe_ingredients);
            return $recipe;
        }
        return false;
    }

    /**
     * get all recipes from a specific type from DB
     * @param string $type the type to search for
     * @return Recipe|Recipes|bool one recipe or recipes of the given type or false if there is no recipe in the DB
     */
    function getRecipesByType(string $type): array
    {
        $type_id = $this->typeManager->getTypeId($type);
        $result = $this->connection->query("
            SELECT id FROM recipe WHERE type_id ='$type_id'");
        $recipes = [];
        while ($row = $result->fetch()) {
            $recipes[] = $this->getRecipe($row['id']);
        }
        return $recipes;
    }

    /**
     * get one random recipes from a specific category from DB
     * @param string $category the category to search for
     * @return Recipe|bool one recipe or false if there is no match
     */
    function getOneRandomRecipeByCategory(string $category): Recipe|bool
    {
        $recipes = $this->getRecipesByCategory($category);
        if (count($recipes) > 0) {
            $random_number = rand(0, (sizeof($recipes) - 1));
            $recipe = $recipes[$random_number];
            return $recipe;
        }
        return false;
    }

    /**
     * get all recipes from a specific category from DB
     * @param string $category the category to search for
     * @return Recipe|Recipes|bool one recipe or recipes of the given category or false if there is no recipe in the DB
     */
    function getRecipesByCategory(string $category): array
    {
        $category_id = $this->categoryManager->getCategoryId($category);
        $result = $this->connection->query("
            SELECT id FROM recipe WHERE category_id ='$category_id'");
        $recipes = [];
        while ($row = $result->fetch()) {
            $recipes[] = $this->getRecipe($row['id']);
        }
        return $recipes;
    }

    /**
     * displays the recipe with all the details on the page
     * @param Recipe $recipe the recipe to be displayed
     */
    function displayRecipe(Recipe $recipe)
    {
        $recipe_id = $recipe->getId();
        $user = $recipe->getUser();
        $category = $recipe->getCategory();
        $type = $recipe->getType();
        $date = $recipe->getPublishedDate();
        $recipe_ingredients = $recipe->getRecipeIngredients();
        echo "
            <div class= 'flex_container_recipe'> 
                <div class= 'flex_item_recipe_content'>
                    <p>" . $user->getUserName() . " hat dieses Rezept am " .
            $date->format('d.m.Y') . " um " . $date->format('H:i:s') . " gepostet.
                    </p> 
                    <h2>" . $recipe->getTitle() . "</h2>
                    <p>" . $category->getName() . " | " . $type->getName() . "</p> 
                    <p>";
        $rating = $this->ratingManager->getRating($recipe_id);
        $rating_count = $this->ratingManager->getRatingCount($recipe_id);
        if ($rating > 0) {
            $rating_average = $rating / $rating_count;
            echo $this->ratingManager->displayRating($rating_average) . " (" . $rating_count . " Bewertungen)";
        } else {
            echo str_repeat("<img class='cookerhood' src = ./img/cookerhood.png>", 5);
            echo "noch keine Bewertungen. </p>";
        }
        echo "</p>";
        echo " </p> 
        Zutaten: <br/>
        <table >";
        foreach ($recipe_ingredients as $recipe_ingredient) {
            echo " <tr >
                    <td class='unit_of_measurements' > " .
                $recipe_ingredient->getAmount() . " " . $recipe_ingredient->getUnitOfMeasurementName() . " </td >
               <td class='ingredients' > " . $recipe_ingredient->getIngredientName() . " </td >
                    </td >
                      </tr > ";
        }
        echo "</table > ";
        echo " <p > " . $recipe->getContent() . " </p >
             <p><br/>";
        if ($this->userManager->isLoggedIn()) {
            echo "
            <div class='rating_favorite'>
                <p>Rezept bewerten:</p>";
            $this->ratingManager->rating($recipe_id);
            echo " </div>
            <div class='rating_favorite'>
                <p>Rezept merken:</p>
                </br>
                <button class='favorite_button'>&#10084;</button>
            </div>";
//            <form>
//
//            <input class='favorite' id='favorite' type='radio' name='favorite'/>
//            <label class='favorite' for='favorite'></label>
//
//            </form>";
//            $this->favoriteRecipe($user->getId(), $recipe_id);
        }
        echo "</p>
                </div >
                <div class= 'flex_item_recipe_picture' > ";
        $photoUrl = $recipe->getPhotoUrl();

        if (strlen($photoUrl) != 0) {
            $url = 'uploads/' . $photoUrl;
            echo "<img src = $url alt = 'Bild des Rezeptes' height='200'> ";
        }
        echo " </div >
            </div > ";
    }

    /**
     * displays a short version of the recipe on the page
     * @param Recipe $recipe the recipe to be displayed
     */
    function displayShortVersionOfRecipe(Recipe $recipe)
    {
        $slug = $recipe->getSlug();
        $recipe_id = $recipe->getId();
        $user = $recipe->getUser();
        $category = $recipe->getCategory();
        $type = $recipe->getType();
        echo "
            <div class= 'flex_container_recipe'> 
                <div class= 'flex_item_recipe_content'>                    
                    <a id='link' href='./recipe.view.php?id=" . $recipe_id . "?" . $slug . "'>" . $recipe->getTitle() . "</a>
                    <p>von " . $user->getUserName() . " </p> 
                    <p>" . $category->getName() . " | " . $type->getName() . "</p> 
                    <p>";
        $rating = $this->ratingManager->getRating($recipe_id);
        $rating_count = $this->ratingManager->getRatingCount($recipe_id);
        if ($rating > 0) {
            $rating_average = $rating / $rating_count;
            echo $this->ratingManager->displayRating($rating_average) . " (" . $rating_count . " Bewertungen)";
        } else {
            echo str_repeat("<img class='cookerhood' src = ./img/cookerhood.png>", 5);
            echo "noch keine Bewertungen. </p>";
        }
        echo "</div>
        <div class='flex_item_recipe_picture'> ";

        $photoUrl = $recipe->getPhotoUrl();
        if (strlen($photoUrl) != 0) {
            $url = 'uploads/' . $photoUrl;
            echo "<img src = $url alt = 'Bild des Rezeptes' height='200'> ";
        }
        echo " </div >
            </div > ";
    }

    /**
     * updates the photo-url in the DB
     * @param string $photoUrl the new url
     * @param int $recipe_id the id of the recipe from which the url is to be updated
     */
    function updatePhotoUrl(string $photoUrl, int $recipe_id)
    {
        $ps = $this->connection->prepare('UPDATE recipe SET photo_url = :photo_url WHERE id = :recipe_id');
        $ps->bindValue('photo_url', $photoUrl);
        $ps->bindValue('recipe_id', $recipe_id);
        $ps->execute();
    }

    /**
     * checks whether the title already exists
     * @param string $title
     * @return bool  true, if title already exists, false otherwise
     */
    function titleExists(string $title): bool
    {
        $result = $this->connection->query("SELECT id FROM recipe WHERE title='.$title.'");
        if ($result->fetch()) {
            return true;
        } else return false;
    }

    function updateRecipe(Recipe $recipe)
    {
        $ps = $this->connection->prepare('UPDATE recipe
        SET title = :title, content = :content, slug = :slug, user_id = :user_id, category_id = :category_id, type_id = :type_id,
            photo_url = :photo_url, published_date = :published_date, rating = :rating
        WHERE  id = :id');
        $ps->bindValue('title', $recipe->getTitle());
        $ps->bindValue('content', $recipe->getContent());
        $ps->bindValue('slug', $recipe->getSlug());
        $ps->bindValue('user_id', $recipe->getUser()->getId());
        $ps->bindValue('category_id', $recipe->getCategory()->getId());
        $ps->bindValue('type_id', $recipe->getType()->getId());
        $ps->bindValue('photo_url', $recipe->getPhotoUrl());
        $ps->bindValue('published_date', date('Y-m-d H:i:s', $recipe->getPublishedDate()->getTimestamp()));
        $ps->bindValue('rating', $recipe->getRating());
        $ps->bindValue('id', $recipe->getId());
        $ps->execute();

        $this->recipeIngredientManager->deleteRecipe_Ingredients($recipe->getId());
        $recipe_ingredients = $recipe->getRecipeIngredients();
        $recipe_id = $recipe->getId();
        foreach ($recipe_ingredients as $r) {
            $ingredient_name = $r->getIngredientName();
            $ingredient_id = ($this->ingredientManager->createIngredient($ingredient_name));
            $unitOfMeasurement_name = ($r->getUnitOfMeasurementName());
            $unitOfMeasurement_id = ($this->measuringUnitManager->getMeasuringUnitId($unitOfMeasurement_name));
            $amount = $r->getAmount();
            $this->recipeIngredientManager->createRecipe_Ingredient($recipe_id, $ingredient_id, $unitOfMeasurement_id, $amount);
        }
    }

    function favoriteRecipe(int $user_id, int $recipe_id)
    {
        $ps = $this->connection->prepare('INSERT INTO user_has_favorites (user_id, recipe_id) VALUES (:user_id, :recipe_id)');
        $ps->bindValue('user_id', $user_id);
        $ps->bindValue('recipe_id', $recipe_id);
        $ps->execute();
    }

    /**
     * deletes all recipes from one user from DB
     * @param int $user_id the id from the user
     */
    function deleteRecipesFromUser(int $user_id)
    {
        $recipes = $this->getRecipesByUser($user_id);
        foreach ($recipes as $recipe) {
            $this->deleteRecipe($recipe);
        }
    }

    /**
     * get all recipes from a specific user id from DB
     * @param int $id the id from the user
     * @return Recipe|Recipes|bool one recipe or recipes  of the given user id or false if there is no recipe in the DB
     */
    public function getRecipesByUser($id): array
    {
        $result = $this->connection->query("
            SELECT id FROM recipe WHERE user_id ='$id'");
        $recipes = [];
        while ($row = $result->fetch()) {
            $recipes[] = $this->getRecipe($row['id']);
        }
        return $recipes;
    }

    /**
     * deletes the given recipe from DB
     * @param Recipe $recipe the recipe to be deleted
     */
    function deleteRecipe(Recipe $recipe)
    {
        $id = $recipe->getId();
        $this->connection->query("
            DELETE FROM recipe_has_ingredient_has_unit_of_measurement WHERE recipe_id = $id");
        $this->connection->query("
            DELETE FROM recipe WHERE id = $id");
    }


}