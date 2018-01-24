<?php

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();

        foreach(range(1,10) as $index)
        {
            DB::table('branch')->insert([
                'branch_name' => str_random(10),
                'branch_description' => $data->paragraph,
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
                'created_by' => 1,
                'updated_by' => 1,
            ]);
        }
    }
}
