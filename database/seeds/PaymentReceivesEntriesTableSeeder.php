<?php

use Illuminate\Database\Seeder;

class PaymentReceivesEntriesTableSeeder extends Seeder
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
            DB::table('payment_receives_entries')->insert([
                'amount'      		    => $data->numberBetween(50,100),
                'invoice_id'            => $data->numberBetween(1,10),
                'payment_receives_id'   => $data->numberBetween(1,10),
                'created_at'            => $data->dateTime($max = 'now'),
                'updated_at'            => $data->dateTime($max = 'now'),
                'created_by'            => $data->numberBetween(1,10),
                'updated_by'            => $data->numberBetween(1,10),
            ]);
        }
    }
}
