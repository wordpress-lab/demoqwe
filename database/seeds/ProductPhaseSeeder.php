<?php

use Illuminate\Database\Seeder;

class ProductPhaseSeeder extends Seeder
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
            DB::table('product_phase')->insert([
                'product_phase_name' => str_random(10),
                'status' => str_random(10),
                'product_id' => $data->numberBetween(1,10), 
                'created_by' => $data->numberBetween(1,10),
                'updated_by' => $data->numberBetween(1,10),
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
        }
    }
}
