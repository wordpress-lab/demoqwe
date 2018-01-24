<?php

use Illuminate\Database\Seeder;

class ModuleDeleteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();
        
        // Module Delete
        DB::table('mudule_delete')->insert([
            'id' => 1,
            'name' => 'ticketing',
            'status' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('mudule_delete')->insert([
            'id' => 2,
            'name' => 'manpower',
            'status' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('mudule_delete')->insert([
            'id' => 3,
            'name' => 'recruit',
            'status' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('mudule_delete')->insert([
            'id' => 4,
            'name' => 'hazz',
            'status' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('mudule_delete')->insert([
            'id' => 5,
            'name' => 'umrah',
            'status' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('mudule_delete')->insert([
            'id' => 6,
            'name' => 'hrm',
            'status' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('mudule_delete')->insert([
            'id' => 7,
            'name' => 'pms',
            'status' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

    }
}
