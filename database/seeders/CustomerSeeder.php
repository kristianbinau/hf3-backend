<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($x = 1 ; $x <= 2500 ; $x++) {
            DB::table('customers')->insert([
                'login_id' => $faker->numberBetween(1,1000),
                'address_id' => $faker->numberBetween(1,5000),
                'name' => $faker->name(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
