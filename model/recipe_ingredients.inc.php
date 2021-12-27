<?php

/**
 * This class represents a type-safe container for objects of the recipe_ingredient class
 */
class recipe_ingredients extends IteratorIterator {
    public function __construct(Recipe_Ingredient ...$recipe_Ingredients) {
        parent::__construct(new ArrayIterator($recipe_Ingredients));
    }

    public function current(): Recipe_Ingredient {
        return parent::current();
    }

    public function add(Recipe_Ingredient $recipe_Ingredient)
    {
        $this->getInnerIterator()->append($recipe_Ingredient);
    }
    public function set(int $key, Recipe_Ingredient $recipe_Ingredient)
    {
        $this->getInnerIterator()->offsetSet($key, $recipe_Ingredient);
    }
}