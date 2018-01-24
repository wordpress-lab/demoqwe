<?php

use Illuminate\Database\Seeder;

class CreditNoteEntriesTableSeeder extends Seeder
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
            DB::table('credit_note_entries')->insert([
                'quantity'        => $data->numberBetween(1,10),
                'rate'            => $data->numberBetween(1,10),
                'amount'          => $data->numberBetween(1,10),
                'discount'        => $data->numberBetween(1,10),
                'item_id'         => $data->numberBetween(1,10),
                'credit_note_id'  => $data->numberBetween(1,10),
                'tax_id'          => $data->numberBetween(1,5),
                'account_id'      => $data->numberBetween(1,10),
                'created_at'      => $data->dateTime($max = 'now'),
                'updated_at'      => $data->dateTime($max = 'now'),
                'created_by'      => $data->numberBetween(1,10),
                'updated_by'      => $data->numberBetween(1,10),
            ]);
        }
    }
}
