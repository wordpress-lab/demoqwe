<?php

use Illuminate\Database\Seeder;

class PaymentMadeTableSeeder extends Seeder
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
            DB::table('payment_made')->insert([
                'amount'             => $data->numberBetween(1,100),
                'payment_date'       => $data->dateTime($max = 'now'),
                'payment_mode_id'       => $data->numberBetween(1,5),
                'reference'          => str_random(10),
                'excess_amount'      => $data->numberBetween(1,10),
                'account_id'         => $data->numberBetween(1,10),
                'vendor_id'          => $data->numberBetween(1,10),
                'created_at'         => $data->dateTime($max = 'now'),
                'updated_at'         => $data->dateTime($max = 'now'),
                'created_by'         => $data->numberBetween(1,10),
                'updated_by'         => $data->numberBetween(1,10),
            ]);
        }
    }
}
