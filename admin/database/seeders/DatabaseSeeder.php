<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Product::factory(1000)
        //                     ->hassku(2)
        //                     ->create();

        \App\Models\Batch::factory(200000)
                        ->hasstock(1)
                        ->create();
    }
}
