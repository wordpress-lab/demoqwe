<?php

use Illuminate\Database\Seeder;

class JournalTableSeeder extends Seeder
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
            DB::table('journal')->insert([
                'date'       => str_random(10),
                'reference'  => str_random(10),
                'note'       => $data->paragraph,
                'branch_id'  => $data->numberBetween(1,10),
                'created_by' => $data->numberBetween(1,10),
                'updated_by' => $data->numberBetween(1,10),
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
        }
    }
}
