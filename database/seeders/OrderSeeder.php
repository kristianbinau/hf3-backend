<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($x = 1 ; $x <= 5000 ; $x++) {
            DB::table('orders')->insert([
                'customer_id' => $faker->numberBetween(1,2500),
                'extra_info' => $faker->randomElement([null, $faker->text()]),
                'status' => $faker->randomElement(['NOT ORDERED', 'ORDER PLACED', 'ORDER ACCEPTED', 'ORDER SEND']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
