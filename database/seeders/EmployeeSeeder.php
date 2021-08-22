<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($x = 1 ; $x <= 200 ; $x++) {
            DB::table('employees')->insert([
                'department_id' => $faker->numberBetween(1,20),
                'address_id' => $faker->numberBetween(1,5000),
                'login_id' => $x + 2500,
                'name' => $faker->name(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
