<?php

use Illuminate\Database\Seeder;

class ExpenseTableSeeder extends Seeder
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
            DB::table('expense')->insert([
                'date'            => $data->dateTime($max = 'now'),
                'amount'          => $data->numberBetween(1,100),
                'payment_mode_id'    => $data->numberBetween(1,5),
                'tax_total'       => $data->numberBetween(1,100),
                'reference'       => str_random(10),
                'note'            => str_random(10),
                'account_id'      => $data->numberBetween(1,10),
                'vendor_id'       => $data->numberBetween(1,10),
                'tax_id'          => $data->numberBetween(1,5),
                'tax_type'        => $data->numberBetween(1,2),
                'created_at'      => $data->dateTime($max = 'now'),
                'updated_at'      => $data->dateTime($max = 'now'),
                'created_by'      => $data->numberBetween(1,10),
                'updated_by'      => $data->numberBetween(1,10),
            ]);
        }
    }
}
