<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $data = Faker\Factory::create();

        DB::table('roles')->insert([
            'name' => 'Admin',
            'description' => $data->paragraph,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('roles')->insert([
            'name' => 'Staff',
            'description' => $data->paragraph,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('roles')->insert([
            'name' => 'Employee',
            'description' => $data->paragraph,
            'created_by' => 1,
            'updated_by' => 1,
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);

        DB::table('users')->update([
            'role_id'    => 1,
            'branch_id'  => 1,
            'created_by' => 1,
            'updated_by' => 1
        ]);
    }
}
