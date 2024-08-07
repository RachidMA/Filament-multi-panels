<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ingredient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {


        // Select a random ingredient
        //$ingredient = $this->faker->randomElement($ingredients);

        return [
            'name' => '',
            'description' => '',
            'quantity' => '',
            'unit' => '',
            'reorder_point' => '',
            'supplier_id' => Supplier::inRandomOrder()->value('id'),
            'cost_per_unit' => '',
        ];
    }
}
