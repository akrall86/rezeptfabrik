<?php
require_once __DIR__ . '/../model/category.php';

/**
 * The CategoryManager class contains methods for editing the table category.
 */
class CategoryManager {
    private PDO $conn;

    /**
     * @param PDO $conn the connection to the DB
     */
    public function __construct(PDO $conn) {
        $this->conn = $conn;
    }

    /**
     * insert category into DB
     * @param string $name the name of the category
     */
    function createCategory(string $name) {
        $ps = $this->conn->prepare('INSERT INTO category (name) VALUES (:name)');
        $ps->bindValue('name', $name);
        $ps->execute();
    }

    /**
     * get one category from DB
     * @return Category
     */
    function getCategoryById($id): Category {
        $result = $this->conn->query("SELECT * FROM category WHERE id='$id'");
        if ($row = $result->fetch()) {
            $category = new Category($row['id'], $row['name']);
        }
        return $category;
    }

    /**
     * get all categories from DB
     * @return array of categories
     */
    function getCategories(): array {
        $result = $this->conn->query('SELECT * FROM category');
        $categories = [];
        while ($row = $result->fetch()) {
            $categories[] = new Category($row['id'], $row['name']);
        }
        return $categories;
    }

    /**
     * get id from given category name
     * @return int|bool the id or false if there is no match
     */
    function getCategoryId($name): int|bool {
        $result = $this->conn->query("SELECT id FROM category WHERE name = '$name'");
        if ($row = $result->fetch()) {
            return $row['id'];
        }
        return false;
    }

    /**
     * deletes one category from db
     * @param string $name the name of the category to be deleted
     */
    function deleteCategory(int $id) {
        $ps = $this->conn->query('DELETE FROM category WHERE id = (:id)');
        $ps->bindValue('id', $id);
        $ps->execute();
    }



}