<?php

namespace Database\Seeders;

use Carbon\Carbon;
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
                    DB::table('countries')->insert([
                        'sub_region_id' => $subRegionId,
                        'name' => $country['name'],
                        'native_name' => $country['nativeName'],
                        'flag' => $country['flag'],
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);
                }
            }
        }
    }
}
