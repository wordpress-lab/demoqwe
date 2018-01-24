<?php

use Illuminate\Database\Seeder;

class BillEntryTableSeeder extends Seeder
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
            DB::table('bill_entry')->insert([
                'item_id'           => $data->numberBetween(1,10),
                'account_id'        => $data->numberBetween(1,10),
                'quantity'          => $data->numberBetween(1,1000),
                'rate'              => $data->numberBetween(1,100),
                'tax_id'            => $data->numberBetween(1,5),
                'amount'            => $data->numberBetween(1,50),
                'bill_id'           => $data->numberBetween(1,10),
                'created_at'        => $data->dateTime($max = 'now'),
                'updated_at'        => $data->dateTime($max = 'now'),
                'created_by'        => 1,
                'updated_by'        => 1,
            ]);
        }
    }
}
