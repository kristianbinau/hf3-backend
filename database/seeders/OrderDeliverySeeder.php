<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($x = 1 ; $x <= 1000 ; $x++) {
            DB::table('order_deliveries')->insert([
                'order_id' => $faker->numberBetween(1,5000),
                'address_id' => $faker->numberBetween(1,5000),
                'order_delivery_type_id' => $faker->numberBetween(1,5),
                'carrier' => 'Carrier: ' . $faker->word(),
                'tracking_id' => $faker->uuid(),
                'status' => $faker->randomElement(['DELIVERY NOT INITIATED', 'DELIVERY INITIATED', 'DELIVERY SEND', 'DELIVERY IN-PERSON']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
