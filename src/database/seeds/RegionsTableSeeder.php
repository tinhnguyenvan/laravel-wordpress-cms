<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        set_time_limit(0);
        $regions = file_get_contents(storage_path('database/region/geo.json'));
        $regions = json_decode($regions, true);

        foreach ($regions as $key => $region) {
            DB::table('master_regions')->insert(
                [
                    'code' => $region['code'],
                    'name' => $region['name'],
                    'address' => $region['address'],
                    'is_primary_location' => $region['isPrimaryLocation'],
                    'source_id' => $region['id'],
                    'source_parent_id' => $region['parent_id'],
                    'level' => $region['level'],
                ]
            );

            if ($key % 100 == 0) {
                sleep(1);
            }
        }
    }
}
