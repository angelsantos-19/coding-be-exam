<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Category 1', 'Category 2', 'Category 3', 'Category 4', 'Category 5'];
        return [
            'name' => $this->faker->userName(),
            'category' => $this->faker->randomElement($categories),
            'description' => $this->faker->paragraph(2),
            'datetime' => $this->faker->DateTime(),
        ];
    }
}
