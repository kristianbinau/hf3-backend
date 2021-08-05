<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://restcountries.eu/rest/v2/all");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($json, true);

        $invertAPI = [];

        foreach ($obj as $countries) {
            $invertAPI[$countries['region']][$countries['subregion']][] = [
                'name' => $countries['name'],
                'nativeName' => $countries['nativeName'],
                'flag' => $countries['flag'],
            ];
        }

        foreach ($invertAPI as $region => $subRegions) {
            $regionId = DB::table('regions')->insertGetId([
                'name' => $region,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            foreach($subRegions as $subRegion => $countries) {
                $subRegionId = DB::table('sub_regions')->insertGetId([
                    'region_id' => $regionId,
                    'name' => $subRegion,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                foreach($countries as $country) {
                    $countryId = DB::table('countries')->insertGetId([
                        'sub_region_id' => $subRegionId,
                        'name' => $country['name'],
                        'native_name' => $country['nativeName'],
                        'flag' => $country['flag'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                    for ($x = 1 ; $x <= 5 ; $x++) {
                        $cityId = DB::table('cities')->insertGetId([
                            'country_id' => $countryId,
                            'zipcode' => $faker->postcode(),
                            'name' => $faker->city(),
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);

                        for ($y = 1 ; $y <= 5 ; $y++) {
                            DB::table('addresses')->insert([
                                'city_id' => $cityId,
                                'road' => $faker->streetName(),
                                'road_num' => $faker->buildingNumber(),
                                'apartment_floor' => $faker->randomElement([null, $faker->numberBetween(0, 40)]),
                                'apartment_num' => $faker->randomElement([null, $faker->numberBetween(0, 300)]),
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
