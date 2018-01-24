<?php

use Illuminate\Database\Seeder;

class CreditNotesTableSeeder extends Seeder
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
            DB::table('credit_notes')->insert([
                
                'credit_note_number'  => str_random(10),
                'reference'           => str_random(10),
                'credit_note_date'    => str_random(10),
                'shiping_charge'      => $data->numberBetween(1,10),
                'adjustment'          => $data->numberBetween(1,10),
                'total_credit_note'   => $data->numberBetween(1,10),
                'available_credit'    => $data->numberBetween(1,10),
                'customer_id'         => $data->numberBetween(1,10),
                'customer_note'       => $data->paragraph,
                'terms_and_condition' => $data->paragraph,
                'created_at'          => $data->dateTime($max = 'now'),
                'updated_at'          => $data->dateTime($max = 'now'),
                'created_by'          => $data->numberBetween(1,10),
                'updated_by'          => $data->numberBetween(1,10),
            ]);
        }
    }
}
