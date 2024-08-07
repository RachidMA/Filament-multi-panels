<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = ['grams', 'kilograms', 'liters', 'milliliters', 'pieces'];
        $ingredients = [
            [
                'name' => 'Mozzarella Cheese',
                'description' => 'Soft, white, fresh cheese used for pizzas.',
                'quantity' => 5000,
                'unit' => 'grams',
                'reorder_point' => 1000,
                'cost_per_unit' => 5.00,
            ],
            [
                'name' => 'Tomato Sauce',
                'description' => 'Rich and tangy tomato sauce for pizzas.',
                'quantity' => 10000,
                'unit' => 'milliliters',
                'reorder_point' => 2000,
                'cost_per_unit' => 2.50,
            ],
            [
                'name' => 'Pepperoni',
                'description' => 'Sliced spicy pepperoni for toppings.',
                'quantity' => 2000,
                'unit' => 'grams',
                'reorder_point' => 500,
                'cost_per_unit' => 8.00,
            ],
            [
                'name' => 'Bell Peppers',
                'description' => 'Fresh green bell peppers.',
                'quantity' => 3000,
                'unit' => 'grams',
                'reorder_point' => 500,
                'cost_per_unit' => 3.00,
            ],
            [
                'name' => 'Onions',
                'description' => 'Chopped white onions for toppings.',
                'quantity' => 3000,
                'unit' => 'grams',
                'reorder_point' => 500,
                'cost_per_unit' => 2.00,
            ],
            [
                'name' => 'Mushrooms',
                'description' => 'Sliced fresh mushrooms.',
                'quantity' => 2000,
                'unit' => 'grams',
                'reorder_point' => 500,
                'cost_per_unit' => 4.00,
            ],
            [
                'name' => 'Olive Oil',
                'description' => 'High-quality extra virgin olive oil.',
                'quantity' => 5000,
                'unit' => 'milliliters',
                'reorder_point' => 1000,
                'cost_per_unit' => 7.00,
            ],
            [
                'name' => 'Basil',
                'description' => 'Fresh basil leaves for garnish.',
                'quantity' => 1000,
                'unit' => 'grams',
                'reorder_point' => 200,
                'cost_per_unit' => 10.00,
            ],
            [
                'name' => 'Parmesan Cheese',
                'description' => 'Grated Parmesan cheese for toppings.',
                'quantity' => 3000,
                'unit' => 'grams',
                'reorder_point' => 500,
                'cost_per_unit' => 12.00,
            ],
            [
                'name' => 'Ham',
                'description' => 'Sliced ham for Hawaiian pizzas.',
                'quantity' => 2000,
                'unit' => 'grams',
                'reorder_point' => 500,
                'cost_per_unit' => 9.00,
            ],
        ];
        foreach ($ingredients as $ingredient) {
            \App\Models\Ingredient::factory()->create([
                'name' => $ingredient['name'],
                'description' => $ingredient['description'],
                'quantity' => $ingredient['quantity'],
                'unit' => $ingredient['unit'],
                'reorder_point' => $ingredient['reorder_point'],
                'cost_per_unit' => $ingredient['cost_per_unit'],
            ]);
        }
    }
}
