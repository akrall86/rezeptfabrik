<?php

class Recipe_Ingredient{
   public string $ingredient_name;
   public string $unit_Of_Measurement_name;
   public int $amount;

    /**
     * @param string $ingredient_name
     * @param string $unit_Of_Measurement_name
     * @param int $amount
     */
    public function __construct(string $ingredient_name, string $unit_Of_Measurement_name, int $amount) {
        $this->ingredient_name = $ingredient_name;
        $this->unit_Of_Measurement_name = $unit_Of_Measurement_name;
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getIngredientName(): string {
        return $this->ingredient_name;
    }

    /**
     * @param string $ingredient_name
     */
    public function setIngredientName(string $ingredient_name): void {
        $this->ingredient_name = $ingredient_name;
    }

    /**
     * @return string
     */
    public function getUnitOfMeasurementName(): string {
        return $this->unit_Of_Measurement_name;
    }

    /**
     * @param string $unit_Of_Measurement_name
     */
    public function setUnitOfMeasurementName(string $unit_Of_Measurement_name): void {
        $this->unit_Of_Measurement_name = $unit_Of_Measurement_name;
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