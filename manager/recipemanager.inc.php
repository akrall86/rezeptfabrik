<?php
require_once __DIR__ . '/../model/recipe.inc.php';

/**
 * The RecipeManager class contains methods for editing the table recipe
 */
class RecipeManager
{

    private PDO $conn;

    /**
     * @param PDO $connection the connection to the DB
     */
    public function __construct(PDO $connection)
    {
        $this->conn = $connection;
    }

    /**
     * insert recipe into DB
     * check title in DB if exist
     * check slug in DB if exist
     * @param string $title
     * @param string $content
     * @param string $slug
     * @param int $user_id
     * @param string $category_name
     * @param string $type_name
     * @param string $photo_url
     * @param DateTime $published_date
     * @return string $id return the id of recipe, return $errors[]
     */
    function createRecipe(string $title, string $content, string $slug, int $user_id, string $category_name, string $type_name, string $photo_url, DateTime $published_date): string
    {
        if ($this->getTitle($title) == true) {
            return $errors['title'] = 'Titel wird schon verwendet!';
        }

        if ($this->getSlug($slug) == true) {
            return $errors['slug'] = 'Slug wird schon verwendet!';
        }

        $ps = $this->conn->prepare('
        INSERT INTO recipe
        (title, content, slug, user_id, category_name, type_name, photo_url, published_date)
        VALUES 
        (:title, :content, :slug, :user_id, :category_name, :type_name, :photo_url, :published_date)');

        $ps->bindValue('title', $title);
        $ps->bindValue('content', $content);
        $ps->bindValue('slug', $slug);
        $ps->bindValue('user_id', $user_id);
        $ps->bindValue('category_name', $category_name);
        $ps->bindValue('type_name', $type_name);
        $ps->bindValue('photo_url', '');
        $ps->bindValue('published_date', date('Y-m-d H:i:s'));
        $ps->execute();

        return $this->conn->lastInsertId();
    }

    /**
     * @param $slug
     * @return bool|Recipe
     */
    function getSlug($slug): bool|Recipe
    {
        $ps = $this->conn->prepare('SELECT * FROM recipe WHERE slug = :slug');
        $ps->bindValue('slug', $slug);
        $ps->execute();
        if ($row = $ps->fetch()) {
            return new Recipe($row['id'], $row['title'], $row['content'], $row['slug'], $row['user_id'], $row['category_id'], $row['type_id'], $row['photo_url'], $row['published_date']);
        }
        return false;
    }

    /**
     * @param $title
     * @return bool|Recipe
     */
    function getTitle($title): bool|Recipe
    {
        $ps = $this->conn->prepare('SELECT * FROM recipe WHERE title = :title');
        $ps->bindValue('title', $title);
        $ps->execute();
        if ($row = $ps->fetch()) {
            return new Recipe($row['id'], $row['title'], $row['content'], $row['slug'], $row['user_id'], $row['category_id'], $row['type_id'], $row['photo_url'], $row['published_date']);
        }
        return false;
    }

    /**
     * @return array
     */
    function getRecipes(): array
    {
        $result = $this->conn->query('SELECT * FROM recipe');
        $recipes = [];
        while ($row = $result->fetch()) {
            $recipes[] = new Recipe($row['id'], $row['title'], $row['content'], $row['slug'], $row['user_id'], $row['category_id'], $row['type_id'], $row['photo_url'], $row['published_date']);
        }

        return $recipes;
    }

    function getRecipeById($id)
    {

    }
}