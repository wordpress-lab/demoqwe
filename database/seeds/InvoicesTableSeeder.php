<?php

use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();
        $i = 1;
        foreach(range(1,10) as $index)
        {
            DB::table('invoices')->insert([
                'invoice_number' => $i++,
                'file_name'      => str_random(10),
                'file_url'       => str_random(10),
                'invoice_date'   => $data->dateTime($max = 'now'),
                'payment_date'   => $data->dateTime($max = 'now'),
                'customer_note'  => $data->paragraph,
                'tax_total'      => $data->numberBetween(20,40),
                'shipping_charge' => $data->numberBetween(1,10),
                'adjustment'     => $data->numberBetween(20,40),
                'total_amount'   => $data->numberBetween(1,10),
                'customer_id'    => $data->numberBetween(1,10),
                'created_at'     => $data->dateTime($max = 'now'),
                'updated_at'     => $data->dateTime($max = 'now'),
                'created_by'     => $data->numberBetween(1,10),
                'updated_by'     => $data->numberBetween(1,10),
            ]);
        }
    }
}
