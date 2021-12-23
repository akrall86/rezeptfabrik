<?php
require_once __DIR__ . '/../inc/maininclude.inc.php';
require_once __DIR__ . '/../model/ingredient.inc.php';
require_once __DIR__ . '/../model/recipe_ingredient.inc.php';
require_once __DIR__ . '/../model/unit_of_measurement.inc.php';

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
     * @param string $name the name of the ingredient
     */
    function createRecipe_Ingredient(int $recipe_id, int $ingredient_id, int $unitOfMeasurement_id, $amount){
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
     * get one ingredient from table ingredient
     * @return array of ingredients
     */
    function getIngredient(string $name): string|false {
        $result = $this->conn->query("SELECT * FROM ingredient WHERE name='$name'");
        if ($result->fetch()) {
            return new string($row['id'], $row['name']);
        } else return false;
    }


    function getAllIngredientsFromRecipe(Recipe $recipe): array {
        $recipe_Ingredients [] = array();
        $recipeId = $recipe->getId();
        $result = $this->conn->query('
        SELECT * FROM recipe_has_ingredient_has_unit_of_measurement rhihuom
        INNER JOIN ingredient i ON rhihuom.ingredient_id = i.id
        INNER JOIN unit_of_measurement uom ON rhihuom.unit_of_measurement_id = uom.id
        WHERE rhihuom.recipe_id  =' . $recipeId);
        while ($row = $result->fetch()) {
            $ingredient = new string($row['id'], $row['name']);
            $unit_Of_Measurement = new string($row['name']);
            $amount = $row['amount'];
            $recipe_Ingredient = new Recipe_Ingredient($ingredient, $amount, $unit_Of_Measurement);
            $recipe_Ingredients [] = $recipe_Ingredient;
        }
        return $recipe_Ingredients;
    }

    /**
     * deletes one ingredient from db
     * @param int $id the id of the ingredient to be deleted
     */
    function deleteIngredient(int $id) {
        $ps = $this->conn->query('DELETE FROM ingredient WHERE id = (:id)');
        $ps->bindValue('id', $id);
        $ps->execute();
    }

}