<?php

use Illuminate\Database\Seeder;

class PaymentMadeEntryTableSeeder extends Seeder
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
            DB::table('payment_made_entry')->insert([
                'amount'            => $data->numberBetween(1,100),
                'payment_made_id'   => $data->numberBetween(1,10),
                'bill_id'        => $data->numberBetween(1,10),
                'created_at'        => $data->dateTime($max = 'now'),
                'updated_at'        => $data->dateTime($max = 'now'),
                'created_by'        => $data->numberBetween(1,10),
                'updated_by'        => $data->numberBetween(1,10),
            ]);
        }
    }
}
