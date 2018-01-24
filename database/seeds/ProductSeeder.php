<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
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
            DB::table('product')->insert([
                'product_name' => str_random(10),
                'total_product' => $data->numberBetween(1,10),                
                'branch_id'  =>  $data->numberBetween(1,10),
                'created_by' => $data->numberBetween(1,10),
                'updated_by' => $data->numberBetween(1,10),
                'created_at' => $data->dateTime($max = 'now'),
                'updated_at' => $data->dateTime($max = 'now'),
            ]);
        }
    }
}
