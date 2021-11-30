<?php
require_once __DIR__ . '/../model/recipe.inc.php';

class RecipeManager
{

    private PDO $conn;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->conn = $connection;
    }

    function createRecipe(string $title, string $content, string $slug, int $user_id, string $category_name, string $type_name, string $photo_url, DateTime $published_date)
    {

    }

}