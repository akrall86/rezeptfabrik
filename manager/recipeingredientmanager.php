<?php
require_once __DIR__ . '/../inc/maininclude.php';
require_once __DIR__ . '/../model/ingredient.php';
require_once __DIR__ . '/../model/recipe_ingredient.php';
require_once __DIR__ . '/../model/unit_of_measurement.php';

/**
 * The RecipeIngredientManager class contains methods for editing the tables ingredient, unit_of_measurement and
 * recipe_has_ingredient_has_unit_of_measurement
 */
class RecipeIngredientManager {
    private PDO $conn;

    /**
     * @param PDO $conn the connection to the db
     */
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    /**
     * insert recipe id, ingredient id, unitOfMeasurement id and amount into table
     * recipe_has_ingredient_has_unit_of_measurement
     * @param int $recipe_id the id of the recipe
     * @param int $ingredient_id the id of the ingredient
     * @param int $unitOfMeasurement_id the id of the unit of measurement
     * @param float $amount the amount of the ingredient
     */
    function createRecipe_Ingredient(int $recipe_id, int $ingredient_id, int $unitOfMeasurement_id, float $amount) {
        $ps = $this->conn->prepare('
        INSERT INTO recipe_has_ingredient_has_unit_of_measurement  
            (recipe_id, ingredient_id, unit_of_measurement_id, amount) VALUES (
        :recipe_id, :ingredient_id, :unit_of_measurement_id, :amount)');
        $ps->bindValue('recipe_id', $recipe_id);
        $ps->bindValue('ingredient_id', $ingredient_id);
        $ps->bindValue('unit_of_measurement_id', $unitOfMeasurement_id);
        $ps->bindValue('amount', $amount);
        $ps->execute();
    }

    /**
     * get all ingredients with unit of measurement and amount of the given recipe
     * @param Recipe $recipe the recipe from which the ingredients are to be fetched
     * @return Recipe_Ingredients
     */
    function getAllIngredientsFromRecipe(Recipe $recipe): array {
        $recipe_Ingredients =[];
        $recipeId = $recipe->getId();
        $result = $this->conn->query('
        SELECT i.name as ingredient_name, uom.name as uof_name, rhihuom.amount
               FROM recipe_has_ingredient_has_unit_of_measurement rhihuom
        INNER JOIN ingredient i ON rhihuom.ingredient_id = i.id
        INNER JOIN unit_of_measurement uom ON rhihuom.unit_of_measurement_id = uom.id
        WHERE rhihuom.recipe_id  =' . $recipeId);
        while ($row = $result->fetch()) {
            $recipe_Ingredient = new Recipe_Ingredient($row['ingredient_name'], $row['uof_name'], $row['amount']);
            $recipe_Ingredients [] = $recipe_Ingredient;
        }
        return $recipe_Ingredients;
    }

    /**
     * deletes all ingredients of the recipe from db
     * @param int $id the id of the recipe from which the ingredients schould be deleted
     */
    function deleteRecipe_Ingredients(int $recipe_id) {
        $this->conn->query("
            DELETE FROM recipe_has_ingredient_has_unit_of_measurement WHERE recipe_id = $recipe_id");
    }

}