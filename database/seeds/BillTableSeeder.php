<?php

use Illuminate\Database\Seeder;

class BillTableSeeder extends Seeder
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
            DB::table('bill')->insert([
                'order_number'       => $data->numberBetween(1,100),
                'bill_number'        => $data->numberBetween(1,100),
                'amount'             => $data->numberBetween(1,1000),
                'due_amount'         => $data->numberBetween(1,1000),
                'bill_date'          => $data->dateTime($max = 'now'),
                'due_date'           => $data->dateTime($max = 'now'),
                'item_rates'         => $data->numberBetween(1,50),
                'note'               => $data->paragraph,
                'total_tax'          => $data->numberBetween(1,200),
                'file_url'           => str_random(10),
                'file_name'          => str_random(10),
                'created_at'         => $data->dateTime($max = 'now'),
                'updated_at'         => $data->dateTime($max = 'now'),
                'vendor_id'          => $data->numberBetween(1,10),
                'created_by'         => 1,
                'updated_by'         => 1,
            ]);
        }
    }
}
