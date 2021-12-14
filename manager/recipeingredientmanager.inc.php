<?php
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
     * insert ingredient into DB
     * @param string $name the name of the ingredient
     * @return string the id
     */
    function createRecipe_Ingredient(Recipe_Ingredient $recipe_Ingredient)  {
        $ingredient = $recipe_Ingredient->getIngredient();
        $unit_Of_Measurement = $recipe_Ingredient->getUnitOfMeasurement();
        $amount = $recipe_Ingredient->getAmount();
        $ps = $this->conn->prepare('INSERT INTO ingredient (name) VALUES (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
        $ingredient_id = $this->conn->lastInsertId();

    }
}

/**
 * get one ingredient from table ingredient
 * @return array of ingredients
 */
function getIngredient(string $name): Ingredient|false {
    $result = $this->conn->query('SELECT * FROM ingredient WHERE name=$name');
    if ($result->fetch()) {
        return new Ingredient($row['id'], $row['name']);
    } else return false;
}

/**
 * get all ingredients from db
 * @return array of ingredients
 */
function getIngredients(): array {
    $result = $this->conn->query('SELECT * FROM ingredient');
    $ingredients = [];
    while ($row = $result->fetch()) {
        $ingredients[] = new Ingredient($row['id'], $row['name']);
    }
    return $ingredients;
}


function getAllIngredientsFromRecipe(Recipe $recipe): array {
    $recipeId = $recipe->getId();
    $result = $this->conn->query('
        SELECT ingredient.name, unit_of_measurement.name FROM ingredient 
            JOIN unit_of_measurement ON ingredient.id = (
                SELECT ingredient_id FROM recipe_has_ingredient_has_unit_of_measurement as rhihuom WHERE recipe_id = $recipeId)
            JOIN unit_of_measurement ON unit_of_measurement.id= rhihuom.unit_of_measurement_id');

    $ingredients = $result = array('1' => array('blabla', 'g'), '2' => array('blabla', 'ml'));
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