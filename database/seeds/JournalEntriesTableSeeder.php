<?php

use Illuminate\Database\Seeder;

class JournalEntriesTableSeeder extends Seeder
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
            DB::table('journal_entries')->insert([
                'note'                       => $data->paragraph,
                'debit_credit'               => $data->numberBetween(0,1),
                'amount'                     => $data->numberBetween(50,100),
                'account_name_id'            => $data->numberBetween(1,10),
                'jurnal_type'                => $data->numberBetween(1,4),
                'journal_id'                 => $data->numberBetween(1,10),
                'invoice_id'                 => $data->numberBetween(1,10),
                'payment_receives_id'        => $data->numberBetween(1,10),
                'payment_receives_entries_id'=> $data->numberBetween(1,10),
                'credit_note_refunds_id'     => $data->numberBetween(1,10),
                'credit_note_id'             => $data->numberBetween(1,10),
                'contact_id'                 => $data->numberBetween(1,10),
                'tax_id'                     => $data->numberBetween(1,5),
                'created_by'                 => $data->numberBetween(1,10),
                'updated_by'                 => $data->numberBetween(1,10),
                'created_at'                 => $data->dateTime($max = 'now'),
                'updated_at'                 => $data->dateTime($max = 'now'),
            ]);
        }
    }
}
