<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($x = 1 ; $x <= 100000 ; $x++) {
            DB::table('items')->insert([
                'product_id' => $faker->numberBetween(1,10000),
                'location_id' => $faker->numberBetween(1,10),
                'discount_price' => $faker->randomElement([null, null, $faker->numberBetween(1000,3000000)]),
                'status' => $faker->randomElement(['IN INVENTORY', 'RESERVED', 'ORDER PLACED', 'PURCHASED']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
