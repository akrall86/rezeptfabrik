<?php
require_once __DIR__ . '/../model/ingredient.php';

/**
 * The IngredientManager class contains methods for editing the table ingredient.
 */
class IngredientManager
{
    private PDO $conn;

    /**
     * @param PDO $conn the connection to the db
     */
    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    /**
     * insert ingredient into DB
     * @param string $name the name of the ingredient
     * @return string the id
     */
    function createIngredient(string $name): string
    {
        if ($this->getIngredient($name) === false) {
            $ps = $this->conn->prepare('INSERT INTO ingredient (name) VALUES (:name)');
            $ps->bindValue('name', $name);
            $ps->execute();
            return $this->conn->lastInsertId();
        } else {
            $ingredient = $this->getIngredient($name);
            return $ingredient->getId();
        }
    }

    /**
     * get one ingredient from table ingredient
     * @return array of ingredients
     */
    function getIngredient(string $name): Ingredient|false
    {
        $result = $this->conn->query("SELECT * FROM ingredient WHERE name='" . $name . "'");
        if ($row = $result->fetch()) {
            return new Ingredient($row['id'], $row['name']);
        } else return false;
    }

    /**
     * get all ingredients from db
     * @return array of ingredients
     */
    function getIngredients(): array
    {
        $result = $this->conn->query('SELECT * FROM ingredient');
        $ingredients = [];
        while ($row = $result->fetch()) {
            $ingredients[] = new Ingredient($row['id'], $row['name']);
        }
        return $ingredients;
    }

    /**
     * deletes one ingredient from db
     * @param int $id the id of the ingredient to be deleted
     */
    function deleteIngredient(int $id)
    {
        $ps = $this->conn->query('DELETE FROM ingredient WHERE id = (:id)');
        $ps->bindValue('id', $id);
        $ps->execute();
    }

}