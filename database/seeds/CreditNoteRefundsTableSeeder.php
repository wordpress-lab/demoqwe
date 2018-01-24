<?php

use Illuminate\Database\Seeder;

class CreditNoteRefundsTableSeeder extends Seeder
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
            DB::table('credit_note_refunds')->insert([
                'amount'         => $data->numberBetween(50,100),
                'payment_mode_id'=> $data->numberBetween(1,5),
                'date'           => $data->dateTime($max = 'now'),
                'reference'      => $data->numberBetween(50,100),
                'account_id'     => $data->numberBetween(1,10),
                'credit_note_id' => $data->numberBetween(1,10),
                'created_at'     => $data->dateTime($max = 'now'),
                'updated_at'     => $data->dateTime($max = 'now'),
                'created_by'     => $data->numberBetween(1,10),
                'updated_by'     => $data->numberBetween(1,10),
            ]);
        }
    }
}
