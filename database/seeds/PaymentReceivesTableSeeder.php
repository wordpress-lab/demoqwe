<?php

use Illuminate\Database\Seeder;

class PaymentReceivesTableSeeder extends Seeder
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
            DB::table('payment_receives')->insert([
                'payment_date'              => str_random(10),
                'reference'                 => str_random(10),
                'note'                      => $data->paragraph,
                'amount'                    => $data->numberBetween(50,100),
                'excess_payment'            => $data->numberBetween(50,100),
                'file_name'                 => str_random(10),
                'file_url'                  => str_random(10),
                'payment_mode_id'           => $data->numberBetween(1,5),
                'account_id'                => $data->numberBetween(1,10),
                'customer_id'               => $data->numberBetween(1,10),
                'created_at'                => $data->dateTime($max = 'now'),
                'updated_at'                => $data->dateTime($max = 'now'),
                'created_by'                => $data->numberBetween(1,10),
                'updated_by'                => $data->numberBetween(1,10),
            ]);
        }
    }
}
