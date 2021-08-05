<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($x = 1 ; $x <= 20 ; $x++) {
            DB::table('departments')->insert([
                'location_id' => $faker->numberBetween(1,10),
                'name' => $faker->randomElement(['Sales', 'Storage', 'Management']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
