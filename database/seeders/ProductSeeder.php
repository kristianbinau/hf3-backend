<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($x = 1 ; $x <= 10000 ; $x++) {
            DB::table('products')->insert([
                'product_type_id' => $faker->numberBetween(1,100),
                'manufacturer_id' => $faker->numberBetween(1,1000),
                'name' => 'Product: ' . $faker->word(),
                'description' => $faker->text(),
                'price' => $faker->numberBetween(1000,3000000),
                'status' => $faker->randomElement(['IN PRODUCTION', 'DISCONTINUED']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
