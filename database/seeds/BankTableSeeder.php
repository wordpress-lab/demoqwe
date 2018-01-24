<?php

use Illuminate\Database\Seeder;

class BankTableSeeder extends Seeder
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
            DB::table('bank')->insert([
                'type'             => str_random(10),
                'bank_name_id'     => $data->numberBetween(1,10),
                'particulars'      => str_random(10),
                'date'             => str_random(10),
                'cheque_number'    => str_random(10),
                'total_amount'     => $data->numberBetween(1,1000),
                'notes'            => str_random(50),
                'created_at'       => $data->dateTime($max = 'now'),
                'updated_at'       => $data->dateTime($max = 'now'),
         ]);

        }
    }
}

