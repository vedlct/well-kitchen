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
        return [
            'productCode' => $this->faker->name,
            'productName' =>$this->faker->name,
            'categoryId' => $this->faker->uuid,
            'fkbrandId' => $this->faker->uuid,
            'fkidproduct_unit' => $this->faker->uuid,
            'type' => $this->faker->jobTitle,
            'status' => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
            'changed' => $this->faker->randomDigitNotNull,
            'featureImage' => $this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
}
