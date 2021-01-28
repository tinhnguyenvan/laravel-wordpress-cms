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
        DB::table('master_regions')->insert(
            [
                'code' => 'VN',
                'name' => 'Việt Name',
                'is_primary_location' => 1,
                'parent_id' => 0,
            ]
        );
    }
}
