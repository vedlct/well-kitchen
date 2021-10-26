<?php

namespace Database\Factories;

use App\Models\Sku;
use App\Models\Batch;
use App\Models\Brand;
use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class BatchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Batch::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'skuId' =>Sku::inRandomOrder()->first()->skuId,
            'vendor' =>Vendor::inRandomOrder()->first()->vendor_id,
            'storeId' =>Store::inRandomOrder()->first()->storeId,
            'purchasePrice' =>$this->faker->randomNumber(4),
            'salePrice' => $this->faker->randomNumber(4),
            'vatType' => 'TK',
            'vat' => $this->faker->randomNumber(2),
            'created_at' => $this->faker->dateTime(),
            'updated_at' =>$this->faker->dateTime(),
        ];
    }
}
