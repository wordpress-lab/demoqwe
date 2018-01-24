<?php

use Illuminate\Database\Seeder;

class PaymentModeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Faker\Factory::create();

        DB::table('payment_mode')->insert([
            'id' => 1,
            'mode_name' => 'Cash',
            'description' => 'Cash',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);


        DB::table('payment_mode')->insert([
            'id' => 2,
            'mode_name' => 'Bank Cheque',
            'description' => 'Bank Cheque',
            'created_at' => $data->dateTime($max = 'now'),
            'updated_at' => $data->dateTime($max = 'now'),
        ]);
    }
}
