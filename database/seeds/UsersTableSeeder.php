<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();


            DB::table('users')->insert([
                'name' => str_random(10),
                'image' => 'user.jpg',
                'contact' => 'user.jpg',
                'note' => $data->paragraph,
                'email' => 'admin@mail.com',
                'password' => bcrypt('adminpass'),
                'activated' => 1,
                'type' => 0,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
    }
}
