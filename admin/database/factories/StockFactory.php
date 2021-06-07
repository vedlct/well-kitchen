<?php

namespace Database\Factories;

use App\Models\Sku;
use App\Models\Order;
use App\Models\Stock;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stock::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fkskuId' =>Sku::inRandomOrder()->first()->skuId,
            'order_id' =>Order::inRandomOrder()->first()->orderId,
            'stock' =>$this->faker->randomNumber(2),
            'type' =>'in',
            'identifier' =>'purchase',
            'created_at' =>$this->faker->dateTime(),
            'updated_at' =>$this->faker->dateTime(),
        ];
    }
}
