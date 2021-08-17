<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->randomElement(['Watch', 'Phone', 'Laptop']);
        $color = $this->faker->colorName();
        $branch = $this->faker->randomElement(['Samsung', 'Apple', 'Motorola']);
        $letter = $this->faker->randomLetter;
        $nb = $this->faker->numberBetween(1, 99);
        $price = $this->faker->numberBetween(300, 700);
        $price *= 1000;

        return [
            'name' => "{$branch} {$name} {$nb}{$letter} {$color}",
            'price' => $price
        ];
    }
}
