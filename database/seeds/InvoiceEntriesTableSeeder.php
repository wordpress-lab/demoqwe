<?php

use Illuminate\Database\Seeder;

class InvoiceEntriesTableSeeder extends Seeder
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
            DB::table('invoice_entries')->insert([
                'quantity'      => $data->numberBetween(20,50),
                'rate'          => $data->numberBetween(1,10),
                'amount'        => $data->numberBetween(50,100),
                'discount'      => $data->numberBetween(10,20),
                'item_id'       => $data->numberBetween(1,10),
                'tax_id'        => $data->numberBetween(1,5),
                'account_id'    => $data->numberBetween(1,10),
                'invoice_id'    => $data->numberBetween(1,10),
                'created_at'    => $data->dateTime($max = 'now'),
                'updated_at'    => $data->dateTime($max = 'now'),
                'created_by'    => $data->numberBetween(1,10),
                'updated_by'    => $data->numberBetween(1,10),
            ]);
        }
    }
}
