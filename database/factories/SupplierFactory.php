<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Supplier>
 */
class SupplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /*
        'name', //SUPIER COMPANY NAME
        'contact_person',
        'email',
        'phone',
        'address'
        */
        return [
            //CREATE FAKE DATA FOR 'name', //SUPIER COMPANY NAME: contact_person, email, phone, address
            'name' => $this->faker->company,
            'contact_person' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address
        ];
    }
}
