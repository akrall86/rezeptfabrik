<?php
require_once __DIR__ . '/../model/category.inc.php';

/**
 * The CategoryManager class contains methods for editing the table category.
 */
class CategoryManager
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
     * insert category into DB
     * @param string $name the name of the category
     */
    function createCategory(string $name)
    {
        $ps = $this->conn->prepare('INSERT INTO category (name) VALUES (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

    /**
     * get all categories from db
     * @return array of categories
     */
    function getCategories(): array
    {
        $result = $this->conn->query('SELECT * FROM category');
        $categories = [];
        while ($row = $result->fetch()) {
            $categories[] = new Category($row['name']);
        }
        return $categories;
    }

    /**
     * deletes one category from db
     * @param string $name the name of the category to be deleted
     */
    function deleteCategory(string $name)
    {
        $ps = $this->conn->query('DELETE FROM category WHERE name = (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

}