<?php

namespace Database\Seeders;

use App\Models\OrderDelivery;
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
        $this->call([
            AddressSeeder::class,
            LoginSeeder::class,
            CustomerSeeder::class,
            LocationSeeder::class,
            DepartmentSeeder::class,
            EmployeeSeeder::class,
            ManufacturerSeeder::class,
            ProductTypeSeeder::class,
            ProductSeeder::class,
            ItemSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            OrderDeliveryTypeSeeder::class,
            OrderDeliverySeeder::class,
            OrderDiscountSeeder::class,
        ]);
    }
}
