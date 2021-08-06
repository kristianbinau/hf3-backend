<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($x = 1 ; $x <= 20000 ; $x++) {
            DB::table('order_items')->insert([
                'order_id' => $faker->numberBetween(1,5000),
                'item_id' => $faker->numberBetween(1,100000),
                'price' => $faker->numberBetween(1000,3000000),
                'status' => $faker->randomElement(['NOT ORDERED', 'ORDER PLACED', 'ORDER ACCEPTED', 'ORDER SEND']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
