<?php

/**
 * This class represents a type-safe container for objects of the recipe_ingredient class
 */
class recipe_ingredients extends ArrayIterator {
    public function __construct(Recipe_Ingredient ...$recipe_ingredients) {
        parent::__construct($recipe_ingredients);
    }

    public function current(): Recipe_Ingredient {
        return parent::current();
    }

    public function add(Recipe_Ingredient $recipe_ingredient) {
        $this->append($recipe_ingredient);
    }

    public function remove(Recipe_Ingredient $recipe_ingredient){
       $array = $this->getArrayCopy();
        $key = array_search($recipe_ingredient, $array);
        $this->offsetUnset($key);
    }


}