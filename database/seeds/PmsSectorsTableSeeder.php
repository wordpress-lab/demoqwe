<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PmsSectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();

        DB::table('pms_sectors')->insert([
            'id' => 1,
            'type' => 0,
            'required' => 1,
            'name' => "Absence",
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('pms_sectors')->insert([
            'id' => 2,
            'type' => 0,
            'required' => 0,
            'name' => "Advance",
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);
    }
}
