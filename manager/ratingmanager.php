<?php

/**
 * The RatingManager class contains methods that display and evaluate the rating and import it into the database
 */
class RatingManager
{
    private PDO $connection;

    /**
     * @param PDO $conn the connection to the db
     */
    public function __construct(PDO $conn)
    {
        $this->connection = $conn;
    }

    /**
     * shows the rating of the recipe
     * @param float $count the rating
     * @return string the display of the recipe
     */
    function displayRating(float $count): string
    {
        $length = strlen((string)$count);
        $max_count = 5;
        if ($length == 1 ) {
            return str_repeat("<img class='cookerhood' src = ./img/cookerhood_full.png>", $count) .
                str_repeat("<img class='cookerhood' src = ./img/cookerhood.png>", ($max_count - $count));
        } else {
            $count = floor($count);
            return str_repeat("<img class='cookerhood' src = ./img/cookerhood_full.png>", $count) .
                "<img class='cookerhood' src = ./img/cookerhood_half.png>" .
                str_repeat("<img class='cookerhood' src = ./img/cookerhood.png>", ($max_count - $count - 1));
        }
    }

    /**
     * outputs a form in which the rating can be entered
     * calls the method to update the rating in the DB when the form is submitted
     * @param int $recipe_id the id of the recipe to be rated
     */
    function rating(int $recipe_id)
    {
        $rating = 0;
        echo "<div class='cookerhood_rating'>
             <p>Rezept bewerten:</p>
            <form action='./recipe.view.php?id=$recipe_id' method='post'>";
        for ($i = 1; $i <= 5; $i++) {
            echo "<input class='cookerhood_rating cookerhood-$i' id='cookerhood-$i' type='radio' name='cookerhood-$i'/>
                  <label class='cookerhood_rating cookerhood-$i' for='cookerhood-$i'></label>";
        }
        echo " <button name='rate'>Bewertung absenden</button>       
            </form>";
        if (isset($_POST['rate'])) {
            for ($i = 1; $i <= 5; $i++) {
                if (isset($_POST['cookerhood-' . $i])) {
                    $rating = 6 - $i;
                }
            }
            $this->updateRating($recipe_id, $rating);
        }
        echo "</div>";
    }

    /**
     * updates the rating in the DB
     * @param int $recipe_id the recipe from which the data should be updated
     * @param int $rating the points of the rating
     */
    function updateRating(int $recipe_id, int $rating)
    {
        $old_rating = $this->getRating($recipe_id);
        $old_rating_count = $this->getRatingCount($recipe_id);
        $new_rating = $old_rating + $rating;
        $new_rating_count = $old_rating_count + 1;
        $ps = $this->connection->prepare(
            'UPDATE recipe SET rating = :new_rating, rating_count = :new_rating_count WHERE id = :recipe_id');
        $ps->bindValue('new_rating', $new_rating);
        $ps->bindValue('new_rating_count', $new_rating_count);
        $ps->bindValue('recipe_id', $recipe_id);
        $ps->execute();
    }

    /**
     * get rating from one recipe
     * @param int $recipe_id the id from the recipe
     * @return int the total rating of one recipe
     */
    function getRating($recipe_id): int
    {
        $result = $this->connection->query("SELECT * FROM recipe WHERE id='$recipe_id'");
        if ($row = $result->fetch()) {
            $rating = ($row['rating']);
        }
        return $rating;
    }

    /**
     * get rating count from one recipe
     * @param int $recipe_id the id from the recipe
     * @return int the total rating count of one recipe
     */
    function getRatingCount($recipe_id): int
    {
        $result = $this->connection->query("SELECT * FROM recipe WHERE id='$recipe_id'");
        if ($row = $result->fetch()) {
            $rating_count = ($row['rating_count']);
        }
        return $rating_count;
    }


}
