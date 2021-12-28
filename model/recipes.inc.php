<?php

/**
 * This class represents a type-safe container for objects of the recipe class
 */
class recipes extends ArrayIterator {
    public function __construct(Recipes ...$recipes) {
        parent::__construct($recipes);
    }

    public function current(): Recipe {
        return parent::current();
    }

    public function add(Recipe $recipe) {
        $this->append($recipe);
    }

}