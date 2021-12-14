<?php

class Recipe_Ingredient{
   public Ingredient $ingredient;
   public Unit_Of_Measurement $unit_Of_Measurement;
   public int $amount;

    /**
     * @param Ingredient $ingredient
     * @param Unit_Of_Measurement $unit_Of_Measurement
     * @param int $amount
     */
    public function __construct(Ingredient $ingredient, Unit_Of_Measurement $unit_Of_Measurement, int $amount) {
        $this->ingredient = $ingredient;
        $this->unit_Of_Measurement = $unit_Of_Measurement;
        $this->amount = $amount;
    }

    /**
     * @return Ingredient
     */
    public function getIngredient(): Ingredient {
        return $this->ingredient;
    }

    /**
     * @param Ingredient $ingredient
     */
    public function setIngredient(Ingredient $ingredient): void {
        $this->ingredient = $ingredient;
    }

    /**
     * @return Unit_Of_Measurement
     */
    public function getUnitOfMeasurement(): Unit_Of_Measurement {
        return $this->unit_Of_Measurement;
    }

    /**
     * @param Unit_Of_Measurement $unit_Of_Measurement
     */
    public function setUnitOfMeasurement(Unit_Of_Measurement $unit_Of_Measurement): void {
        $this->unit_Of_Measurement = $unit_Of_Measurement;
    }

    /**
     * @return int
     */
    public function getAmount(): int {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount(int $amount): void {
        $this->amount = $amount;
    }




}