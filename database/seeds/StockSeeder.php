<?php

use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
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
            DB::table('stock')->insert([
                'total' => $data->numberBetween(1,10),
                'date' => str_random(10),
                'item_category_id' => $data->numberBetween(1,10),
                'item_id' => $data->numberBetween(1,10),
                'branch_id' => $data->numberBetween(1,10),
                'created_by' => $data->numberBetween(1,10),
                'updated_by' => $data->numberBetween(1,10),
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
        }
    }
}
